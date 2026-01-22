@extends('layouts.app')

@section('title', 'Crear Producto')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Crear Producto</h4>
            </div>
            <div class="card-body">
                
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
                        <label for="name" class="form-label fw-bold">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name') }}" maxlength="50" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="price" class="form-label fw-bold">Precio</label>
                        <div class="input-group">
                            <span class="input-group-text">L.</span>
                            <input type="text" step="0.01" class="form-control myInput" id="price" name="price" 
                                   value="{{ old('price') ? number_format(old('price'), 2, ',', '.') : '' }}" 
                                   min="1" max="1000000" required>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-1"></i>Guardar
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
        
    </div>
</div>
@endsection