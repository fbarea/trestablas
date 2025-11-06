@extends('layouts.main-layout')

@section('page-title', 'Listado de tareas')

@section('content-area')
  <h2>Tareas</h2>

  @if (count($tareas) > 0)

  <table class="table table-striped table-bordered table-hover">
    <thead class="thead-dark">
      <tr>
        <th>&nbsp;</th>
        <th>Tarea</th>
        <th class="celda-de-nueva-tarea">
          <a href="{{ route('tasks.create') }}">
            <i class="material-icons icono-azul">add_box</i>
          </a>
        </th>
      </tr>
    </thead>
    <tbody>
    @foreach($tareas as $tarea)
    
    <tr>
      <td class="celda-de-ver-ciudades">
        <i class="material-icons icono-de-ver-tareas icono-verde" data-icon="{{ $tarea->id }}">visibility</i>
      </td>
      <td>
        <a href="{{ route('tasks.edit',['id'=>$tarea->id]) }}">{{$tarea->tarea}}</a>
      </td>
      <td class="celda-de-eliminar-tarea">
        <a onclick="return confirm('¿Eliminar la tarea: {{ $tarea->tarea  }}?')" href="{{ route('tasks.destroy',['id'=>$tarea->id]) }}">
          <i class="material-icons icono-de-borrar-tarea" data-icon="{{ $tarea->id }}" title="Borrar">delete</i>
        </a>
      </td>
    </tr>
    <tr>
      <td colspan="3" class="celda-de-ciudades {{ $tarea->id }}">
        <table class="tabla-de-ciudades">
        <tr>
          <td class="celda-de-rotulo-de-ciudades">CIUDADES</td>
          <td class="celda-de-boton-de-nueva-ciudad">
            <a href="" class="btn btn-primary btn-sm">Nueva</a>
          </td>
        </tr>
        </table>
        <table class="tabla-de-ciudades">
        @foreach($tarea->cities as $city)
          <tr>
            <td class="celda-de-nombre-de-ciudad">{{ $city->ciudad }} ({{ $city->pais }})</td>
            <td class="celda-de-nombre-de-responsable">{{ $city->manager->nombre }}</td>
            <td class="celda-de-estado">
              <i class="material-icons {{($city->activa == '0') ? 'icono-clase-inactiva' : 'icono-clase-activa'}}">fiber_manual_record</i>
            </td>
            <td class="celda-de-editar-ciudad">
              <a href="{{ route('relations.edit',['task_id'=>$tarea->id,'city_id'=>$city->id]) }}">
                <i class="material-icons icono-de-editar-ciudad icono-editar" title="Editar">edit</i>
              </a>
            </td>
            <td class="celda-de-eliminar-ciudad">
              @if ($tarea->cities->count() == 1)
                <i class="material-icons icono-de-borrar-ciudad-anulado" title="No se puede borrar">delete</i>
              @else
                <a href="{{ route('relations.destroy',['task_id'=>$tarea->id,'city_id'=>$city->id]) }}">
                  <i class="material-icons icono-de-borrar-ciudad" title="Borrar">delete</i>
                </a>
              @endif
            </td>
          </tr>
        @endforeach
        </table>
      </td>
    </tr>

    @endforeach
    </tbody>
  </table>
  
  @else
    <p>En este momento no hay tareas disponibles.</p>
  
    @endif

@endsection

@section('scripts')
<script languaje="javascript" src="{{ asset('js/tareas/tareas.js') }}"></script>
@endsection

