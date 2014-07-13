<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
            // ID пользователя
            $table->increments('id');

            // E-Mail (уникальный)
            $table->string('email')->unique();

            // Пароль
            $table->string('password', 60);

            // Никнейм
            $table->string('username')->unique();

            // Админ?
            $table->boolean('isAdmin');

            // Активирован?
            $table->boolean('isActive')->index();

            // Код активации аккаунта
            $table->string('activationCode');

            // Токен для возможности запоминания пользователя
            $table->rememberToken();

            // created_at, updated_at
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
