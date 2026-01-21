<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- jQuery (requerido por DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS y JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 mb-4">
        <a class="navbar-brand" href="{{ route('products.index') }}">No se</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.create') }}">Crear Producto</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new AutoNumeric('#price', {
                digitGroupSeparator: ',', // separador de miles
                decimalCharacter: '.', // separador decimal
                decimalPlaces: 2, // número de decimales
                minimumValue: '1',
                maximumValue: '1000000',
                currencySymbol: 'L.', // si quieres mostrar un símbolo, ej: '$'
                unformatOnSubmit: true // envía el valor limpio al backend
            });
        });
    </script>
    <script>
$(document).ready(function() {
    $('#products-table').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        },
        pageLength: 10, // filas por página
        ordering: true,  // permitir ordenar
        searching: true  // permitir búsqueda
    });
});
</script>


</body>

</html>