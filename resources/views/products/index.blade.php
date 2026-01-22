{{-- resources/views/products/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Listado de Productos')

@section('content')

{{-- ✅ Card de bienvenida con información del usuario --}}
@auth
<div class="card bg-light mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1">
                <i class="bi bi-hand-wave me-2"></i>¡Hola, {{ Auth::user()->name }}!
            </h5>
            <small class="text-muted">{{ Auth::user()->email }}</small>
        </div>
        <div class="text-end">
            <span class="d-block text-muted small">Tu rol:</span>
            @php
                $role = Auth::user()->role;
                $badgeClass = match($role?->name) {
                    'admin' => 'bg-danger',
                    'editor' => 'bg-warning text-dark',
                    'user' => 'bg-info',
                    default => 'bg-secondary'
                };
                $roleIcon = match($role?->name) {
                    'admin' => 'bi-shield-fill-check',
                    'editor' => 'bi-pencil-square',
                    'user' => 'bi-person-fill',
                    default => 'bi-question-circle'
                };
            @endphp
            <span class="badge {{ $badgeClass }} fs-6">
                <i class="bi {{ $roleIcon }} me-1"></i>
                {{ $role ? ucfirst($role->name) : 'Sin rol' }}
            </span>
        </div>
    </div>
</div>
@endauth

<!-- Header responsive -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
    <h1 class="mb-3 mb-md-0"><i class="bi bi-box-seam me-2"></i>Productos</h1>
    
    {{-- ✅ Solo admin y editor pueden crear productos --}}
    @auth
        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('editor'))
            <a href="{{ route('products.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i>Nuevo Producto
            </a>
        @endif
    @endauth
</div>

@if($products->isEmpty())
    <!-- Estado vacío -->
    <div class="card shadow-sm">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
            <h4 class="text-muted mt-3">No hay productos registrados</h4>
            <p class="text-muted">Comienza agregando tu primer producto</p>
            
            @auth
                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('editor'))
                    <a href="{{ route('products.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-1"></i>Crear Producto
                    </a>
                @endif
            @endauth
        </div>
    </div>
@else
    <!-- Tabla responsive -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="products-table" class="table table-success table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>
                                <strong>{{ $product->name }}</strong>
                            </td>
                            <td data-order="{{ $product->price }}">
                                <span class="text-success fw-bold">
                                    L.{{ number_format($product->price, 2, '.', ',') }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1 justify-content-center flex-wrap">
                                    {{-- ✅ Todos pueden ver --}}
                                    <a href="{{ route('products.show', $product->id) }}" 
                                       class="btn btn-success btn-sm" title="Ver">
                                        <i class="bi bi-eye"></i>
                                        <span class="d-none d-lg-inline ms-1">Ver</span>
                                    </a>
                                    
                                    {{-- Solo admin y editor pueden editar --}}
                                    @auth
                                        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('editor'))
                                            <a href="{{ route('products.edit', $product->id) }}" 
                                               class="btn btn-primary btn-sm" title="Editar">
                                                <i class="bi bi-pencil-fill"></i>
                                                <span class="d-none d-lg-inline ms-1">Editar</span>
                                            </a>
                                        @endif
                                    @endauth
                                    
                                    
                                    @auth
                                        @if(Auth::user()->hasRole('admin'))
                                            <form action="{{ route('products.destroy', $product->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm" title="Eliminar"
                                                        onclick="return confirm('¿Eliminar este producto?')">
                                                    <i class="bi bi-trash-fill"></i>
                                                    <span class="d-none d-lg-inline ms-1">Eliminar</span>
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
@endsection