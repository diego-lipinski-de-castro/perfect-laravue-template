<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return new JsonResponse([
            'message' => 'User created successfully',
            'user' => $user,
            'token' => $user->createToken('Auth Token')->plainTextToken,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return new JsonResponse([
            'message' => 'User logged in successfully',
            'user' => $user,
            'token' => $user->createToken('Auth Token')->plainTextToken,
        ], 200);
    }

    public function me(Request $request)
    {
        return new JsonResponse([
            'message' => 'User authenticated successfully',
            'user' => $request->user(),
        ], 200);
    }
}
