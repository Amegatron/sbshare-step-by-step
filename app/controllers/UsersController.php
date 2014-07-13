<?php

class UsersController extends BaseController {

    public function getRegister() {
        return View::make('users/register');
    }

    public function postRegister() {
        $rules = User::$validation;

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails()) {
            return Redirect::to('users/register')->withErrors($validation)->withInput();
        }

        $user = new User();
        $user->fill(Input::all());
        $id = $user->register();
        return $this->getMessage("Регистрация почти завершена. Вам необходимо подтвердить e-mail, указанный при регистрации, перейдя по ссылке в письме.");
    }

    public function getActivate($userId, $activationCode) {
        // Получаем указанного пользователя
        $user = User::find($userId);
        if (!$user) {
            return $this->getMessage("Неверная ссылка на активацию аккаунта.");
        }

        // Пытаемся его активировать с указанным кодом
        if ($user->activate($activationCode)) {
            // В случае успеха авторизовываем его
            Auth::login($user);
            // И выводим сообщение об успехе
            return $this->getMessage("Аккаунт активирован", "/");
        }

        // В противном случае сообщаем об ошибке
        return $this->getMessage("Неверная ссылка на активацию аккаунта, либо учетная запись уже активирована.");
    }

    public function getLogin() {
        return View::make('users/login');
    }

    public function postLogin() {
        // Формируем базовый набор данных для авторизации
        // (isActive => 1 нужно для того, чтобы аторизоваться могли только
        // активированные пользователи)
        $creds = array(
            'password' => Input::get('password'),
            'isActive'  => 1,
        );

        // В зависимости от того, что пользователь указал в поле username
        // дополняем авторизационные данные
        $username = Input::get('username');
        if (strpos($username, '@')) {
            $creds['email'] = $username;
        } else {
            $creds['username'] = $username;
        }

        // Пытаемся авторизовать пользователя
        if (Auth::attempt($creds, Input::has('remember'))) {
            Log::info("User [{$username}] successfully logged in.");
            return Redirect::intended();
        } else {
            Log::info("User [{$username}] failed to login.");
        }

        $alert = "Неверная комбинация имени (email) и пароля, либо учетная запись еще не активирована.";

        // Возвращаем пользователя назад на форму входа с временной сессионной
        // переменной alert (withAlert)
        return Redirect::back()->withAlert($alert);
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('/');
    }

} 
