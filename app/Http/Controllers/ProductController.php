<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Product::class);
        
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Product::class);
        
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $this->authorize('create', Product::class);
        
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product); // ← Esto faltaba
        
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product); // ← Esto faltaba
        
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product); // ← Esto faltaba
        
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function show(Product $product) // ← Corregido: debe recibir el producto
    {
        $this->authorize('view', $product);
        
        return view('products.show', compact('product'));
    }
}