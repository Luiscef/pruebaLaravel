{{-- resources/views/layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success p-3 mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('products.index') }}">
                <i class="bi bi-shop me-2"></i>Mi Tienda
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- Menú izquierdo --}}
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">
                            <i class="bi bi-box-seam me-1"></i>Productos
                        </a>
                    </li>
                    
                    {{-- Solo admin y editor pueden crear --}}
                    @auth
                        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('editor'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('products.create') }}">
                                    <i class="bi bi-plus-circle me-1"></i>Crear Producto
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
                
                {{-- Menú derecho - Usuario --}}
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" 
                               id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-2 fs-5"></i>
                                <span>{{ Auth::user()->name }}</span>
                                
                                {{-- ✅ Badge con el rol --}}
                                @if(Auth::user()->role)
                                    @php
                                        $roleName = Auth::user()->role->name;
                                        $badgeClass = match($roleName) {
                                            'admin' => 'bg-danger',
                                            'editor' => 'bg-warning text-dark',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} ms-2">
                                        {{ ucfirst($roleName) }}
                                    </span>
                                @endif
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-end">
                                {{-- Info del usuario --}}
                                <li class="dropdown-header">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person-badge me-2"></i>
                                        <div>
                                            <div class="fw-bold">{{ Auth::user()->name }}</div>
                                            <small class="text-muted">{{ Auth::user()->email }}</small>
                                        </div>
                                    </div>
                                </li>
                                
                                {{-- Mostrar rol --}}
                                <li>
                                    <span class="dropdown-item-text">
                                        <i class="bi bi-shield-check me-2"></i>
                                        Rol: 
                                        <strong class="text-success">
                                            {{ Auth::user()->role ? ucfirst(Auth::user()->role->name) : 'Sin rol' }}
                                        </strong>
                                    </span>
                                </li>
                                
                                <li><hr class="dropdown-divider"></li>
                                
                                {{-- Opciones --}}
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-gear me-2"></i>Configuración
                                    </a>
                                </li>
                                
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        {{-- Si no está autenticado --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Iniciar Sesión
                            </a>
                        </li>
                    
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        {{-- Mensajes flash --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // AutoNumeric
            const priceInput = document.getElementById('price');
            if (priceInput) {
                new AutoNumeric('#price', {
                    digitGroupSeparator: ',',
                    decimalCharacter: '.',
                    decimalPlaces: 2,
                    minimumValue: '1',
                    maximumValue: '1000000',
                    currencySymbol: 'L.',
                    unformatOnSubmit: true
                });
            }
        });
    </script>
    
    <script>
        $(document).ready(function() {
            if ($('#products-table').length) {
                $('#products-table').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                    },
                    pageLength: 10,
                    ordering: true,
                    searching: true
                });
            }
        });
    </script>
</body>

</html>