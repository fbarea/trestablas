@extends ('layouts.main-layout')

@section('page-title', 'Relación editada')

@section('content-area')
    <h2>Relación editada</h2>
    <div class="row">
        <p class="alert alert-success">
            Se ha editado correctamente una relación de la tarea {{ $tarea }}.
        </p>
    </div>
    <div class="row"><br></div>
    <div class="row">
        <a class="btn btn-success btn-sm" href="{{ route('tasks.list') }}">Volver al listado</a>
    </div>
@endsection