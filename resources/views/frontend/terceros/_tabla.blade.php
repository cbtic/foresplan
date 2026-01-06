<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>Documento</th>
            <th>Apellidos y Nombres</th>
            <th>Dirección</th>
            <th>Condición</th>
            <th>Sede</th>
        </tr>
    </thead>
    <tbody>
    @forelse($terceros as $t)
        <tr>
            <td>{{ $t->numero_documento }}</td>
            <td>{{ $t->apellido_paterno }} {{ $t->apellido_materno }}, {{ $t->nombres }}</td>
            <td>{{ $t->direccion }}</td>
            <td>{{ $t->condicion_laboral }}</td>
            <td>{{ $t->denominacion_ubic }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">Sin resultados</td>
        </tr>
    @endforelse
    </tbody>
</table>
