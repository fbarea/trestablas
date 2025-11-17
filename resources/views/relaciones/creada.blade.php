@extends ('layouts.main-layout')

@section('page-title', 'Relación creada')

@section('content-area')
    <h2>Relación creada</h2>
    <div class="row">
        <p class="alert alert-success">
            La relación de la tarea {{ $tarea }}
            <br>
            con la ciudad {{ $ciudad }} ha sido creada correctamente.
        </p>
    </div>
    <div class="row"><br></div>
    <div class="row">
        <a class="btn btn-success btn-sm" href="{{ route('tasks.list') }}">Volver al listado</a>
    </div>
@endsection