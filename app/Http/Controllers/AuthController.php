<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|min:6',
        ]);

        $user = User::authenticate(
            $request->usuario,
            $request->password
        );

        if (! $user) {
            return back()->withErrors([
                'usuario' => 'Credenciales incorrectas.',
            ])->onlyInput('usuario');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('products.index')
            ->with('success', '¡Bienvenido ' . $user->name . '!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'usuario' => 'required|string|unique:users,usuario',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('products.index')
            ->with('success', '¡Cuenta creada exitosamente!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Sesión cerrada.');
    }
}
