<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        \Illuminate\Support\Facades\Log::info('Login Attempt:', ['email' => $credentials['email']]);

        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
             \Illuminate\Support\Facades\Log::error('Login Failed: User not found', ['email' => $credentials['email']]);
             return response()->json(['message' => 'User not found'], 401);
        }

        if (!\Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
             \Illuminate\Support\Facades\Log::error('Login Failed: Password mismatch', [
                 'email' => $credentials['email'],
                 'stored_hash' => $user->password,
                 'input_password' => $credentials['password'] // CAUTION: Only for local debugging
             ]);
             return response()->json(['message' => 'Invalid password'], 401);
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('admin-token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        }
        
        return response()->json(['message' => 'Auth::attempt failed despite hash check passing'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
