<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\KamarController;
use \App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Router Kamar
Route ::get('/kamar', [KamarController::class, 'index']);
Route ::post('/kamar', [KamarController::class, 'store']);
Route ::patch('/kamar/{id}', [KamarController::class, 'update']);
Route ::delete('/kamar/{id}', [KamarController::class, 'destroy']);

//Router Category
Route ::get('/category', [CategoryController::class, 'index']);
Route ::post ('/addcategory', [CategoryController::class, 'store']);
Route ::patch ('/category/{id}', [CategoryController::class, 'update']);
Route ::delete ('/category/{id}', [CategoryController::class, 'destroy']);