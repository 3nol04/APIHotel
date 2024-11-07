<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;  // Menggunakan Response dari Laravel

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kamar = Kamar::with('kategori')->get();
        $data['status'] = 200;
        $data['message'] = 'Success';
        $data['kamar'] = $kamar;
        return response()->json($data, Response::HTTP_OK);  // Menggunakan Response dari Laravel
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'no_kamar' => 'required|unique:kamars,no_kamar',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|integer',
            'status_kamar' => 'required|string',
        ]);

        $kamar = Kamar::create($val);
        $data['status'] = 200;
        $data['message'] = 'Success';
        $data['kamar'] = $kamar;
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kamar)
    {
        $val = $request->validate([
            'no_kamar' => 'nullable|string|unique:kamars,no_kamar',
            'category_id' => 'nullable|integer',
            'price' => 'nullable|integer',
            'status_kamar' => '',
        ]);

        // Cari data berdasarkan ID
        $newData = Kamar::where('id_kamar', $kamar)->first();

        // Cek data ada atau tidak
        if (!$newData) {
            return response()->json([
                'status' => 404,
                'message' => 'Kamar not found'
            ], Response::HTTP_NOT_FOUND);
        }

        // Validasi data
        $val['no_kamar'] = $val['no_kamar'] ?? $newData->no_kamar;
        $val['category_id'] = $val['category_id'] ?? $newData->category_id;
        $val['price'] = $val['price'] ?? $newData->price;
        $val['status_kamar'] = $val['status_kamar'] ?? $newData->status_kamar;

        $newData->update($val);
        $data['status'] = 200;
        $data['message'] = 'Success';
        $data['kamar'] = $newData;
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        $show = Kamar::with('kategori')->get();
        $result = Kamar::where('id_kamar', $kamar->id_kamar);
        $result->delete();

        $data['status'] = 200;
        $data['message'] = 'Success';
        $data['kamar'] = $show;
        return response()->json($data, Response::HTTP_OK);
    }
}
