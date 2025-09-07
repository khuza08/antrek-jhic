<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|max:18'
        ]);

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $token = $user->createToken('signup-token')->plainTextToken;

        return response()->json([
            'status' => 'Success',
            'message' => 'Register Success!',
            'token' => $token,
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'  => 'required|email|max:255',
            'password' => 'required|max:16'
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // ✅ Buat token baru untuk user
            $token = $user->createToken('login-token')->plainTextToken;

            return response()->json([
                'status' => 'Success',
                'message' => 'Login Success!',
                'token' => $token,
                'user' => $user
            ], 200);
        }

        return response()->json([
            'status' => 'Invalid',
            'message' => 'Email atau password tidak valid',
        ], 401);
    }

    public function destroy(Request $request)
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'status' => 'Success',
                'message' => 'Anda Berhasil logout',
            ], 200);
        }

        return response()->json(['Unauthenticated user'], 401);
    }
}