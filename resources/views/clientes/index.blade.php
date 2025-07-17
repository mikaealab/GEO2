@extends('layout.app')

@section('Contenido')
<div class="container">
    <h1 class="text-primary">Listado de Clientes</h1>

    <a href="{{ route('clientes.create') }}" class="btn btn-primary">Nuevo Cliente</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="{{ url('clientes/mapa') }}" class="btn btn-primary">Mapa de Clientes</a>

    <table class="table table-bordered table-striped table-hover mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Latitud</th>
                <th>Longitud</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->cedula }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellido }}</td>
                    <td>{{ $cliente->latitud }}</td>
                    <td>{{ $cliente->longitud }}</td>
                    <td>
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning">Editar</a>

                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="form-eliminar d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.form-eliminar');

    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    @if (session('message'))
        Swal.fire({
            title: '¡Éxito!',
            text: '{{ session('message') }}',
            icon: 'success'
        });
    @endif
});
</script>
@endpush
