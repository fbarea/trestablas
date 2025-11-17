@extends('layouts.main-layout')

@section('page-title', 'Crear relación')

@section('content-area')
    <h2>Crear relación de la tarea <strong>{{$tarea->tarea}}</strong>.</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('relations.store') }}" method="post">
        @csrf
        <input type="hidden" name="task_id" value="{{$tarea->id}}">
        <div class="row">
            <div class="col col-sm-4">
                <label for="city">Ciudad
                    <select class="form-control" id="city" name="city" size="10">
                        @foreach($ciudades as $CD)
                        <option value="{{$CD->id}}" {{ (old('city') == $CD->id) ? " selected" : "" }}>
                            {{$CD->ciudad}} ({{$CD->pais}})
                        </option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="col col-sm-4">
                <label for="manager">Gestor
                    <select class="form-control" id="manager" name="manager" size="10">
                        @foreach($managers as $manager)
                        <option value="{{$manager->id}}" {{ (old('manager') == $manager->id) ? " selected" : "" }}>
                            {{$manager->nombre}}
                        </option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="col col-sm-4">
                <div class="row">
                    <label for="f_inicio">F. Inicio
                        <input type="date" class="form-control" id="f_inicio" name="f_inicio" value="{{ old('f_inicio') ? : $fechaPorDefecto }}">
                    </label>
                </div>
                <div class="row"><br></div>
                <div class="row">
                    <label for="f_final">F. Fin
                        <input type="date" class="form-control" id="f_final" name="f_final" value="{{ old('f_final') ? : $fechaPorDefecto }}">
                    </label>
                </div>
                <div class="row"><br></div>
                <div class="row">
                    <label class="form-check-label" for="activa">Tarea activa
                        <input class="form-check-input check-tarea" type="checkbox" value="1" id="activa" name="activa" {{ (old('activa') == "1") ? " checked":"" }}>
                    </label>
                </div>
            </div>
        </div>
        <div class="row"><br></div>
        <div class="row">
            <div class="col col-sm-2 text-left">
                <input type="submit" class="btn btn-success btn-sm" value="Grabar">
            </div>
            <div class="col col-sm-2 text-right">
                <a href="{{ route('tasks.list') }}" class="btn btn-primary btn-sm">
                    Listado
                </a>
            </div>
        </div>
    </form>

@endsection
