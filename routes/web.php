<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;


// Rutas públicas (solo para invitados)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
   
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::middleware(['auth', 'unauthorized.view'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create')
        ->middleware('can:create,App\Models\Product');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit')
        ->middleware('can:update,product');
});
// Pantalla para confirmar eliminación
Route::get('/products/{product}/confirm-delete', [ProductController::class, 'confirmDelete'])
    ->name('products.confirmDelete')
    ->middleware('can:delete,product');

// Rutas protegidas (requieren login)
// Rutas protegidas
Route::middleware('auth')->group(function () {
    // Crear producto (solo admin y editor)
    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create')
        ->middleware('can:create,App\Models\Product');
    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store')
        ->middleware('can:create,App\Models\Product');

    // Mostrar productos
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Editar / eliminar
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('can:update,product');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update')->middleware('can:update,product');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('can:delete,product');
});


// Panel de administración solo para admin
Route::middleware('auth.custom:admin')->group(function () {
    Route::get('/admin', fn() => view('admin.dashboard'))->name('admin.dashboard');
});

// Redirección inicial
Route::get('/', fn() => redirect()->route('login'));
