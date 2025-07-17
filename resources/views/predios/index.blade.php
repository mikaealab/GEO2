@extends('layout.app')

@section('Contenido')
<br>
<div class = "container">
    <h1 class="text-center">Listado de Predios</h1>
    <a href="{{ route('predios.create') }}" class="btn btn-primary">Agregar nuevo Predio</a>
    &nbsp;&nbsp;&nbsp;&nbsp;

    <table class="table table-bordered table-striped table-hover mt-3">
        <thead>
            <tr>
                <th>Propietario</th>
                <th>Clave Catastral</th>
                <th>Coordenada N°1</th>
                <th>Coordenada N°2</th>
                <th>Coordenada N°3</th>
                <th>Coordenada N°4</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($predios as $predioTemporal)
            <tr>
                <td>{{ $predioTemporal->propietario }}</td>
                <td>{{ $predioTemporal->clave }}</td>
                <td>Latitud: {{ $predioTemporal->latitud1 }}<br>Longitud: {{ $predioTemporal->longitud1 }}</td>
                <td>Latitud: {{ $predioTemporal->latitud2 }}<br>Longitud: {{ $predioTemporal->longitud2 }}</td>
                <td>Latitud: {{ $predioTemporal->latitud3 }}<br>Longitud: {{ $predioTemporal->longitud3 }}</td>
                <td>Latitud: {{ $predioTemporal->latitud4 }}<br>Longitud: {{ $predioTemporal->longitud4 }}</td>
                <td class="text-center">
                    <a href="{{ route('predios.edit', $predioTemporal->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('predios.destroy', $predioTemporal->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No hay predios registrados.</td>
            </tr>
            @endforelse
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
