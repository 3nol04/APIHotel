<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $pelanggan = Auth::guard('pelanggan')->user();
        $transaksi = Transaksi::with('kamar')->get();
        $data ['status']= 200;
        $data ['message']= 'Success';
        $data ['transaksi'] = $transaksi;
        $data ['pelanggan'] = $pelanggan;
        return response()->json($data,Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mengecek apakah pengguna autentikasi
        if (Auth::guard('pelanggan')->user()) {

            $pelanggan = Auth::guard('pelanggan')->user();
    
            // Validasi request
            $val = $request->validate([
                'id_transaksi' => 'unique:transaksi,id_transaksi',
                'id_kamar' => 'required',
                'id_pelanggan' => 'required',
            ]);
    
            // Membuat transaksi baru
            $transaksi = Transaksi::create($val);

            $data['status'] = 200;
            $data['message'] = 'Success';
            $data['transaksi'] = $transaksi;
    
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $transaksi)
    {
        $validate = $request -> validate([
            'id_transaksi' => 'required'
        ]);

        $result = Transaksi::where('id_transaksi',$transaksi)->update($validate);

        if ($result){
            $data['success'] = true;
            $data['message'] = "Data transaksi behasil di update";
            $data['result' ] = $result;
            return response()->json($data,Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
  public function destroy( $id_transaksi)
    {
        // Pastikan mencari data berdasarkan UU
        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
        if ($transaksi) {
            // Hapus transaksi jika ditemukan
            $transaksi->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Success'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Transaksi tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
