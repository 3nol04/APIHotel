<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use  Illuminate\Support\Facades\Htto;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $category = Category::all();
        $data ['status']= 200;
        $data ['message']= 'Success';
        $data ['category'] = $category;
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
    public function store(Request $request)
    {
        $val = $request->validate([
            'name_type' => 'required',
            'tipe_kamar' => 'required',
            'description' => 'max:255',
        ]);

        $category = Category::create($val);
        $data ['status']= 200;
        $data ['message']= 'Success';
        $data ['category'] = $category;
        return response()->json($data,Response::HTTP_OK);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $category_id)
    {
        $val = $request->validate([
            'name_type' => 'nullable|string',
            'tipe_kamar' => 'nullable|string',
            'description' => 'nullable|string|max:255',
        ]);
// cek data berdasarkan ID
        $category = Category:: where('category_id', $category_id)->first();

        //cek data ada apa tidak
        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found'
            ], Response::HTTP_NOT_FOUND);
        }

// validasi data
        $val['tipe_kamar'] = $val['tipe_kamar'] ?? $category->tipe_kamar;
        $val['name_type'] = $val['name_type'] ?? $category->name_type;
        $val['description'] = $val['description'] ?? $category->dzescription;


        $category->update($val);
        $data ['status']= 200;
        $data ['message']= 'Success';
        $data ['category'] = $category;
    
        return response()->json($data, Response::HTTP_OK);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
     $result = Category :: where('category_id', $category->category_id); 
     $result->delete();
     $data ['status']= 200;
     $data ['message']= 'Success';
     return response()->json($data,Response::HTTP_OK);
    }
}
