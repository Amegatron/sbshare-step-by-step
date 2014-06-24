<div class="col-md-4">
    <h3>{{{ $planet->planet }}}</h3>
    <p>
        {{ date_create($planet->created_at)->format('d.m.Y H:i:s') }}<br />
        OS: {{ Planet::$oses[$planet->os] }}, Уровень: {{ $planet->level }}<br />
        Координаты: X {{ $planet->x }}, Y {{ $planet->y }}
    </p>

    <p>{{{ $planet->comment }}}</p>

    <p>Просмотров: {{ $planet->views }}</p>

    <p><a class="btn btn-default" href="{{ action('PlanetsController@getView', array($planet->id)) }}" role="button">Детали планеты &raquo;</a></p>
</div>
