@extends('layouts.app')

@section('title', 'Listado de Productos')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h1>Productos</h1>


@if($products->isEmpty())
<p>No hay productos registrados.</p>
@else
<table id="products-table" class="table table-success table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>L.{{ number_format($product->price, 2, '.', ',') }}</td>
            <td>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-eye"></i>
                </a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                </a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm"
                        onclick="return confirm('¿Eliminar este producto?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection