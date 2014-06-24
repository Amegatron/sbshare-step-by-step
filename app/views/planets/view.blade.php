@extends('layout')

@section('title')
Планета {{ $planet->planet }}
@stop

@section('content')
<div class="jumbotron">
    <div class="container">
        <h2>
            Планета {{{ $planet->planet }}}
        </h2>
    </div>
</div>

<div class="container">
    <table class="table table-striped">
        <tr>
            <td>Сектор:</td>
            <td>{{ Planet::$sectors[$planet->sector] }}</td>
        </tr>
        <tr>
            <td>Уровень:</td>
            <td>{{ $planet->level }}</td>
        </tr>
        <tr>
            <td>Звезда:</td>
            <td>{{{ $planet->star }}}</td>
        </tr>
        <tr>
            <td>Система:</td>
            <td>{{{ $planet->system }}}</td>
        </tr>
        <tr>
            <td>Планета:</td>
            <td>{{{ $planet->planet }}}</td>
        </tr>
        <tr>
            <td>Биом:</td>
            <td>{{ Planet::$bioms[$planet->biome] }}</td>
        </tr>
        <tr>
            <td>Координаты:</td>
            <td>
                <table>
                    <tr>
                        <td>X:</td>
                        <td>{{ $planet->x }}</td>
                    </tr>
                    <tr>
                        <td>Y:</td>
                        <td>{{ $planet->y }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>Версия игры:</td>
            <td>{{ Planet::$versions[$planet->version] }}</td>
        </tr>
        <tr>
            <td>OS (операционная система):</td>
            <td>{{ Planet::$oses[$planet->os] }}</td>
        </tr>
        <tr>
            <td>Просмотров:</td>
            <td>{{ $planet->views }}</td>
        </tr>
    </table>
    <p>&nbsp;</p>
    <p>{{{ $planet->comment }}}</p>
</div>
@stop
