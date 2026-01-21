@extends('layouts.app')

@section('title', 'Detalle del Producto')

@section('content')

<a href="{{ route('products.index') }}" class="btn btn-primary">Volver</a>
<table class="table table-success table-striped">
<thead>
    <tr>
        <th>Nombre</th>
        <th>Precio</th>
        

    </tr>
</thead>

@foreach ($products as $product)
<tbody>
    <tr>
        <td>{{ $product->name }}</td>
        <td>L.{{ number_format($product->price, 2, '.', ',') }}</td>
    

    </tr>
    @endforeach
</tbody>
</table>





@endsection