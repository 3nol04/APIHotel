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
            'no_kamar' => 'unique:kamars,no_kamar',
            'category_id' => 'unique:kamars,category_id',
            'price' => 'integer|',
            'status_kamar' => 'default:tersedia',

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
            'no_kamar' => 'nullable|string',
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
    public function destroy(Kamar $kamar)
    {
        $show = Kamar:: with('kategori')->get();    
        $result = Kamar :: where('id_kamar', $kamar->id_kamar); 
        $result->delete();
        $data ['status']= 200;
        $data ['message']= 'Success';
        $data ['kamar'] = $show;
        return response()->json($data,Response::HTTP_OK);
    }
}
