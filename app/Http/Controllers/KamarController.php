<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class KamarController extends Controller
{
    /**
     * Dis play a listing of the resource.
     */
    public function index()
    {
        
        $kamar = Kamar:: with('kategori')->get();
        $data ['status']= 200;
        $data ['message']= 'Success';
        $data ['kamar'] = $kamar;
        return response()->json($data,Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( Request $request)
    {
       $val = $request->validate([
    'no_kamar' => 'required|unique:kamars,no_kamar',
    'category_id' => 'required|exists:categories,category_id',
    'price' => 'required|integer',
    'status_kamar' => 'required|string',
    ]);

    
       
        $kamar = Kamar::create($val);
        $data ['status']= 200;
        $data ['message']= 'Success';
        $data ['kamar'] = $kamar;
        return response()->json($data,Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        
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
        
// cari data berdasarkan ID
        $newData = Kamar::where('id_kamar', $kamar)->first();

        //cek data ada apa tidak
        if(!$newData){
            return response()->json([
                'status' => 404,
                'message' => 'Kamar not found'
            ], Response::HTTP_NOT_FOUND);
        }

// validasi data 
        $val['no_kamar']= $val['no_kamar'] ?? $newData->no_kamar;
        $val['category_id']= $val['category_id'] ?? $newData->category_id;
        $val['price']= $val['price'] ?? $newData->price;
        $val['status_kamar']= $val['status_kamar'] ?? $newData->status_kamar;

        
        $newData->update($val);
        $data ['status']= 200;
        $data ['message']= 'Success';
        $data ['kamar'] = $newData;
        return response()->json($data, Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */

public function destroy($id)
{
    $kamar = Kamar::find($id); // Cari kamar berdasarkan ID

    if (!$kamar) {
        return response()->json([
            'status' => 404,
            'message' => 'Kamar not found'
        ], 404);
    }

    $kamar->delete(); // Hapus kamar

    return response()->json([
        'status' => 200,
        'message' => 'Kamar successfully deleted'
    ], 200);
}


    
}
