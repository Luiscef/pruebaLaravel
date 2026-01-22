@extends('layouts.app')

@section('title', 'Eliminar Producto')

@section('content')
<div class="card shadow-sm">
    <div class="card-body text-center">
        <h3 class="text-danger mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            ¿Eliminar producto?
        </h3>

        <p>Estás a punto de eliminar el producto: <strong>{{ $product->name }}</strong></p>
        <p class="text-muted">Esta acción no se puede deshacer.</p>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash-fill me-1"></i> Confirmar Eliminación
            </button>
        </form>

        <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary ms-2">
            <i class="bi bi-arrow-left me-1"></i> Cancelar
        </a>
    </div>
</div>
@endsection
