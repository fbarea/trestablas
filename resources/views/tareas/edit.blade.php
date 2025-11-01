@extends('layouts.main-layout')

@section('page-title', 'Edición de tarea')

@section('content-area')
    <h2>Editar tarea {{ $tarea->tarea }}</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $tarea->id }}">
        <div class="row">
            <div class="col col-sm-6">
                <label for="tarea">Nombre:
                    <input type="text" class="form-control" id="tarea" name="tarea" value="{{ old('tarea') ? : $tarea->tarea }}">
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
                    <textarea class="form-control" rows="4" id="descripcion" name="descripcion">{{ old('descripcion') ? : $tarea->descripcion }}</textarea>
                </label>
            </div>
        </div>
    </form>

@endsection