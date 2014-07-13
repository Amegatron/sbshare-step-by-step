@extends('layout')

@section('title')
Восстановление пароля
@stop

@section('content')
<div class="container">
    @if (Session::has('status'))
        <div class="alert alert-success">
            {{ Session::get('status') }}
        </div>
    @elseif (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <h2>Восстановление пароля</h2>

    {{ Form::open(array('url' => action('RemindersController@postRemind'), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Ваш E-Mail</label>
        <div class="col-sm-5">
            {{ Form::email('email', null, array('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2">&nbsp;</div>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary">Восстановить</button>
        </div>
    </div>
    {{ Form::close() }}
</div>
@stop
