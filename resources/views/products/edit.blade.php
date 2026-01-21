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
        @php
        $priceValue = old('price') ? old('price') : $product->price;
        @endphp

        <input type="text" step="0.01" class="form-control myInput" id="price" name="price"
       value="{{ old('price', $product->price) }}"
       min="1" max="1000000" required>


    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection