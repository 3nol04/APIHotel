<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register (Request $request)
    {
        $val = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
        $val['umur'] = $val['umur'] ?? date('Y-m-d');
        $val['password'] = bcrypt($val['password']);

        $pelanggan = Pelanggan::create($val);
        $data ['token']= $pelanggan->createToken('Pelanggan')->plainTextToken;
        $data ['status']= 200;
        $data ['message']= 'Success';
        $data ['pelanggan'] = $pelanggan;
        return response()->json($data,Response::HTTP_CREATED);
    }   
    public function login(Request $request)
    {
        if (Auth::guard('pelanggans')->attempt($request->only('email', 'password'))) {
           
            $user = Auth::guard('pelanggans')->user();
    
            
            $data['token'] = $user->createToken('Pelanggan')->plainTextToken;
            $data['status'] = 200;
            $data['message'] = 'Success';
            $data['pelanggan'] = $user;
            
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

   public function getPelayan($id)
{

    $pelayan = Pelanggan::find($id);

    if ($pelayan) {
        return response()->json([
            'status' => 'success',
            'data' => $pelayan
        ], 200); 
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Pelanggan tidak ditemukan'
        ], 404);
    }
}

    public function logout(Request $request)
    {
        // Ambil pengguna dari guard 'pelanggan'
        $user = $request->user('pelanggan');
    
        if ($user) {
            // Hapus token
            $user->currentAccessToken()->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Success'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
    
    
}
