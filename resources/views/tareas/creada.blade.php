@extends ('layouts.main-layout')

@section('page-title', 'Tarea creada')

@section('content-area')
    <h2>Tarea creada</h2>
    <div class="row">
        <p class="alert alert-success">
            La tarea <strong>{{ $tarea }}</strong> ha sido creada correctamente.
        </p>
    </div>
    <div class="row"><br></div>
    <div class="row">
        <a class="btn btn-success btn-sm" href="{{ route('tasks.list') }}">Volver al listado</a>
    </div>
@endsection