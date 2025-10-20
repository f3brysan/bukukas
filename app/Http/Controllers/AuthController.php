<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login failed',
                    'error' => $validator->errors()->first(),
                ], 400);
            }

            $credentials = $request->only('email', 'password');
            if (Auth::guard('web')->attempt($credentials)) {
                $request->session()->regenerate();
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil',  
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Login failed',
                    'error' => 'Email atau Password salah',
                ], 401);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Register failed',
                    'error' => $validator->errors()->first(),
                ], 400);
            }
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Register berhasil',
                'data' => $user,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Register failed',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
