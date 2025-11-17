@extends ('layouts.main-layout')

@section('page-title', 'No hay elementos disponibles')

@section('content-area')

    <h2>No hay {{ $mensaje }}</h2>
    <div class="row">
        <p class="alert alert-danger">
            No quedan <strong>{{ $mensaje }}</strong> disponibles para establecer una relación con la tarea <strong>{{ $tarea }}</strong>.
            <br>
            Borre o edite alguna relación actual.
        </p>
    </div>
    <div class="row"><br></div>
    <div class="row">
        <a class="btn btn-danger btn-sm" href="{{ route('tasks.list') }}">Volver al listado</a>
    </div>
@endsection