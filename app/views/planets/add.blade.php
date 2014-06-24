@extends('layout')

@section('title')
Добавление планеты
@stop

@section('content')
<div class="jumbotron">
    <div class="container">
        @if ($errors->all())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <h2>Добавление планеты</h2>

        {{ Form::open(array('url' => action('PlanetsController@postAdd'), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}
        @include('planets/form')

        <div class="form-group">
            <div class="col-sm-2">&nbsp;</div>
            <div class="col-sm-5">
                <button type="submit" class="btn btn-primary submit-button">Добавить</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@stop
