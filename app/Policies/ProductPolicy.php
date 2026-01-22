<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    public function viewAny(User $user)
    {
        return true; // todos pueden ver la lista
    }

    public function view(User $user, Product $product)
    {
        return true; // todos pueden ver productos individuales
    }

    public function create(User $user)
{
    return $user->hasRole('admin') || $user->hasRole('editor');
}


    public function update(User $user, Product $product)
    {
        return $user->isAdmin(); // solo admin puede editar
    }

    public function delete(User $user, Product $product)
    {
        return $user->isAdmin(); // solo admin puede eliminar
    }
}
