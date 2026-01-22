<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'usuario',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function authenticate(string $usuario, string $password): ?self
    {
        $user = self::where('usuario', $usuario)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            return null;
        }

        return $user;
    }
   public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // ✅ Verificar si tiene un rol específico
    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    

    // ✅ Obtener todos los nombres de roles
    public function getRoleNames(): array
    {
        return $this->roles()->pluck('name')->toArray();
    }
    public function isAdmin(): bool
    {
        return $this->roles()->where('name', 'admin')->exists();
    }
}
