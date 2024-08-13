<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AutentikasiController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

    public function loginCheck(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'email'   => 'required',
            'password' => 'required',
        ]);

        //response error validation
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = User::where('email', $request->email)->where('is_active',1)->first();

        if ($user == null) {
            return response([
                'message' => 'Akun anda belum terdaftar di sistem kami'
            ], 401);
        }

        if($user->email_verified_at == null)
        {
            return response()->json([
                'message' => 'Gagal login, akun belum diverifikasi',
                'email_verified_at' => $user->email_verified_at,
            ],401);
        }

        $checkPass = User::where("password", "!=", Hash::check($request->password, $user->password))->first();

        if ($checkPass == null) {
            return response([
                'message' => 'Password anda Salah'
            ], 401);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Gabungan antara email dan password salah'
            ], 401);
        }

        $tokenResult = $user->createToken('Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login Aplikasi PSB SMA Tamiriyah Surabaya Berhasil, Selamat Datang '.$user->name,
            'token' => $token,
        ],201);
    }
}
