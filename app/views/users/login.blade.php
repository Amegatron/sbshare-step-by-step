@extends('layout')

@section('title')
Вход
@stop

@section('headExtra')
    {{ HTML::style('css/signin.css') }}
@stop

@section('content')
<div class="container">
    @if (Session::has('alert'))
        <div class="alert alert-danger">
            <p>{{ Session::get('alert') }}
        </div>
    @endif

    <form class="form-signin" role="form" action="{{ action('UsersController@postLogin') }}" method="post">
        <h2 class="form-signin-heading">Ваши данные</h2>
        <input type="text" class="form-control" placeholder="Email или имя" name="username" required autofocus />
        <input type="password" class="form-control" placeholder="Password" name="password" required />
        <label class="checkbox">
            <input type="checkbox" name="remember" value="remember-me"> Запомнить меня
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>

        <a href="/password/remind">Забыли пароль?</a><br />
        <a href="/users/register">Регистрация</a>
    </form>
</div>
@stop
