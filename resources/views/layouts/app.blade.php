<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
</body>
</html>
