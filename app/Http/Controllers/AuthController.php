<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\User;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($attr)) {
            return response()->json(['message' => 'gagal'], 401);
        }

        return response()->json(['token' => auth()->user()->createToken('token-login', ['me:show'])->plainTextToken], 200);
    }

    // protected function register(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }
}
