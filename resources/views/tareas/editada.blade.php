@extends ('layouts.main-layout')

@section('page-title', 'Tarea editada')

@section('content-area')
    <h2>Tarea editada</h2>
    <div class="row">
        <p class="alert {{ $clase }}">
            {{ $aviso }}
        </p>
    </div>
    <div class="row"><br></div>
    <div class="row">
        <a class="btn {{ $boton }} btn-sm" href="{{ route('tasks.list') }}">Volver al listado</a>
    </div>
@endsection
