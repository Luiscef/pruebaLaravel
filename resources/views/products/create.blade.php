@extends('layouts.app')

@section('title', 'Crear Producto')

@section('content')
<h1>Crear Producto</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{ route('products.store') }}" method="POST">
@csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" maxlength="50" required>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Precio</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" min="1" max="1000000" required>
        
    </div>
    
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
