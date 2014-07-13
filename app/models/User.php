<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    public static $validation = array(
        // Поле email является обязательным, также это должен быть допустимый адрес
        // электронной почты и быть уникальным в таблице users
        'email'     => 'required|email|unique:users',

        // Поле username является обязательным, содержать только латинские символы и цифры, и
        // также быть уникальным в таблице users
        'username'  => 'required|alpha_num|unique:users',

        // Поле password является обязательным, должно быть длиной не меньше 6 символов, а
        // также должно быть повторено (подтверждено) в поле password_confirmation
        'password'  => 'required|confirmed|min:6',
    );

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

    protected $fillable = array('username', 'email', 'password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    public function register() {
        $this->password = Hash::make($this->password);
        $this->activationCode = $this->generateCode();
        $this->save();
        Log::info("User [{$this->email}] registered. Activation code: {$this->activationCode}");

        $this->sendActivationMail();

        return $this->id;
    }

    public function sendActivationMail() {
        $activationUrl = action(
            'UsersController@getActivate',
            array(
                'userId' => $this->id,
                'activationCode'    => $this->activationCode,
            )
        );

        $that = $this;
        Mail::send('emails/activation',
            array('activationUrl' => $activationUrl),
            function ($message) use($that) {
                $message->to($that->email)->subject('Спасибо за регистрацию!');
            }
        );
    }

    public function activate($activationCode) {
        // Если пользователь уже активирован, не будем делать никаких
        // проверок и вернем false
        if ($this->isActive) {
            return false;
        }

        // Если коды не совпадают, то также ввернем false
        if ($activationCode != $this->activationCode) {
            return false;
        }

        // Обнулим код, изменим флаг isActive и сохраним
        $this->activationCode = '';
        $this->isActive = true;
        $this->save();

        // И запишем информацию в лог, просто, чтобы была :)
        Log::info("User [{$this->email}] successfully activated");

        return true;
    }

    protected function generateCode() {
        return Str::random();
    }
}
