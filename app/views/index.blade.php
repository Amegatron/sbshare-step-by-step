@extends('layout')

@section('title')
База координат Starbound
@stop

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>Русская база координат Starbound</h1>
        <p>Планет в базе: {{ $counter }}</p>
    </div>
</div>

<div class="container">
    <?php
        $planets = array_chunk(iterator_to_array($planets), 3);
    ?>
    @foreach($planets as $planetsChunk)
        <div class="row">
            @foreach($planetsChunk as $planet)
                @include('planets/planet_preview')
            @endforeach
        </div>
    @endforeach
</div>
@stop
