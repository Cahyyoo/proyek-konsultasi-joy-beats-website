<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pemesanan_makanan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function index()
    {
        $pemesanan_makanan = pemesanan_makanan::all();

        return response()->json([
            'status' => 'success',
            'data' => $pemesanan_makanan
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials)) {
            $user = User::where('email', $credentials['email'])->first();
            return response()->json([
                'message' => 'Login berhasil',
                'user' => $user
            ]);
        }

        return response()->json([
            'message' => 'Email atau password salah'
        ], 401);
    }
}
