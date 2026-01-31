@extends('layouts.app')

@section('title', 'Detalle del Producto')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">
        
        <!-- Botón volver -->
        <div class="mb-3">
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-eye me-2"></i>Detalle del Producto</h4>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-success table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <tr>
                                <td><strong>{{ $product->name }}</strong></td>
                                <td>
                                    <span class="text-success fw-bold">
                                        L.{{ number_format($product->price, 2, '.', ',') }}
                                    </span>
                                </td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
        
    </div>
</div>
@endsection