@extends('layouts.main-layout')

@section('page-title', 'Nueva tarea')

@section('content-area')
    <h2>Nueva tarea</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col col-sm-6">
                <label for="tarea">Nombre:
                    <input type="text" class="form-control" id="tarea" name="tarea" value="{{ old('tarea') }}">
                </label>
            </div>
            <div class="col col-sm-3 text-right align-self-end">
                <input type="submit" class="btn btn-success btn-sm" value="Grabar">
            </div>
            <div class="col col-sm-3 text-right align-self-end">
                <a href="{{ route('tasks.list') }}" class="btn btn-primary btn-sm">Listado</a>
            </div>
        </div>
        <div class="row"><br></div>
        <div class="row">
            <div class="col col-sm-12">
                <label for="descripcion">Descripción:
                    <textarea class="form-control" rows="4" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                </label>
            </div>
        </div>
        <div class="row"><br></div>
        <div class="row">
            <div class="col col-sm-4">
                <label for='f_inicio'>Fecha de inicio:
                    <input type="date" class="form-control" id="f_inicio" name="f_inicio" value="{{ (old('f_inicio')) ? : $fecha_por_defecto }}">
                </label>
            </div>
            <div class="col col-sm-4">
                <label for='f_final'>Fecha de finalización:
                    <input type="date" class="form-control" id="f_final" name="f_final" value="{{ (old('f_final')) ? : $fecha_por_defecto }}">
                </label>
            </div>
        </div>
        <div class="row"><br></div>
        <div class="row">
            <div class="col col-sm-4">
                <label for="city_id">Ciudad:
                    <select class="form-control" id="city_id" name="city_id">
                        <option value="00" selected>Seleccione ciudad</option>
                        @foreach ($ciudades as $ciudad)
                            <option value="{{ $ciudad->id }}" {{ (old('city_id') == $ciudad->id) ? " selected":"" }}>{{ $ciudad->ciudad }} ({{ $ciudad->pais }})</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="col col-sm-4">
                <label for="manager_id">Responsable:
                    <select class="form-control" id="manager_id" name="manager_id">
                        <option value="00" selected>Seleccione responsable</option>
                        @foreach ($responsables as $responsable)
                            <option value="{{ $responsable->id }}" {{ (old('manager_id') == $responsable->id) ? " selected":"" }}>{{ $responsable->nombre }} ({{ $responsable->cargo }})</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="col col-sm-4 align-self-end">
                <input class="form-check-input" type="checkbox" value="1" id="activa" name="activa" {{ (old('activa') == "1") ? " checked":"" }}>
                <label class="form-check-label" for="activa">Tarea activa</label>
            </div>
        </div>
    </form>

@endsection
