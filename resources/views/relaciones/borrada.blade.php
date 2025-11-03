@extends ('layouts.main-layout')

@section('page-title', 'Relación borrada')

@section('content-area')
    <h2>Relación borrada</h2>
    <div class="row">
        <p class="alert alert-success">
            La relacion de la tarea <strong>{{ $tarea }}</strong> con la ciudad <strong>{{ $ciudad }}</strong> ha sido borrada correctamente.
            <br>
            Las demás relaciones de la tarea se mantienen.
        </p>
    </div>
    <div class="row"><br></div>
    <div class="row">
        <a class="btn btn-success btn-sm" href="{{ route('tasks.list') }}">Volver al listado</a>
    </div>
@endsection
