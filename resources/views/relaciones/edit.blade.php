@extends('layouts.main-layout')

@section('page-title', 'Editar relación')

@section('content-area')

<div class="container">
    <h2>Editar relación de tarea</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('relations.update', ['task_id' => $tarea->id, 'city_id' => $ciudad->id]) }}" method="POST">
        @csrf
        @method('POST')

        {{-- Nombre de la tarea --}}
        <div class="mb-3">
            <label class="form-label">Tarea</label>
            <input type="text" class="form-control" value="{{ $tarea->tarea }}" readonly>
        </div>

        {{-- Ciudad seleccionable --}}
        <div class="mb-3">
            <label class="form-label">Ciudad</label>
            <select name="city_id" class="form-select">
                @foreach($ciudades as $c)
                    <option value="{{ $c->id }}" {{ $c->id == $ciudad->id ? 'selected' : '' }}>
                        {{ $c->ciudad }} ({{ $c->pais }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Gestor seleccionable --}}
        <div class="mb-3">
            <label class="form-label">Gestor asignado</label>
            <select name="manager_id" class="form-select">
                @foreach($managers as $m)
                    <option value="{{ $m->id }}" {{ $m->id == $manager->id ? 'selected' : '' }}>
                        {{ $m->nombre }} ({{ $m->cargo }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Fechas --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Fecha inicio</label>
                <input type="date" name="f_inicio" class="form-control" value="{{ $relacion->f_inicio }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Fecha fin</label>
                <input type="date" name="f_final" class="form-control" value="{{ $relacion->f_final }}">
            </div>
        </div>

        {{-- Estado activa --}}
        <div class="mb-3">
            <label class="form-label">Activa</label>
            <select name="activa" class="form-select">
                <option value="S" {{ $relacion->activa == 'S' ? 'selected' : '' }}>Sí</option>
                <option value="N" {{ $relacion->activa == 'N' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Actualizar relación</button>
            <a href="{{ route('tasks.list') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection