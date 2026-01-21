@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<h1>Editar Producto</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('products.update', $product->id) }}" method="POST">
@csrf    
@method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" maxlength="50" required>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Precio</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" min="1" max ="1000000" required>
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection


<script>
    const priceInput = document.getElementById('price');

    priceInput.addEventListener('input', function(e) {
        // Quita cualquier carácter que no sea número o punto
        let value = this.value.replace(/[^0-9.]/g, '');

        // Divide en enteros y decimales
        const parts = value.split('.');
        let integerPart = parts[0];
        const decimalPart = parts[1] ? '.' + parts[1].slice(0,2) : '';

        // Agrega comas al entero
        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        // Combina entero y decimal
        this.value = integerPart + decimalPart;
    });

    // Antes de enviar el formulario, quitamos las comas
    const form = priceInput.closest('form');
    form.addEventListener('submit', function() {
        priceInput.value = priceInput.value.replace(/,/g, '');
    });
</script>
