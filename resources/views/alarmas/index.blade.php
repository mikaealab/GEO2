@extends('layout.app')
@section ('Contenido')
<h1>Listado de Alarmas</h1>

<div class="">
    <a href="{{ route('alarmas.create') }}" class="btn btn-outline-primary">
        <i class="fa-solid fa-plus"></i> Registrar nueva alarma
    </a>
    &nbsp;
</div>

&nbsp;&nbsp;
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Serie</th>
            <th>Responsable</th>
            <th>Tipo</th>
            <th>Radio</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($alarma as $alarmaTemp)
            <tr>
                <td>{{$alarmaTemp->id}}</td>
                <td>{{$alarmaTemp->serie}}</td>
                <td>{{$alarmaTemp->responsable}}</td>
                <td>{{$alarmaTemp->tipo}}</td>
                <td>{{$alarmaTemp->radio}}</td>
                <td>{{$alarmaTemp->latitud}}</td>
                <td>{{$alarmaTemp->longitud}}</td>
                <td>
                    <a href="{{ route('alarmas.edit', $alarmaTemp->id) }}" class="btn btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i>Editar</a>
                    <form action="{{ route('alarmas.destroy', $alarmaTemp->id) }}" method="post" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fa-solid fa-trash"></i> Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection<!-- Se cierra el contenido -->