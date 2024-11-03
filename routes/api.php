<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\KamarController;
use \App\Http\Controllers\TransaksiController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route :: post('/register', [AuthController::class, 'register']);
Route :: post('/login', [AuthController::class, 'login']);
Route :: post('/logout', [AuthController::class, 'logout']);
Route::get('/pelayan/{id}', [AuthController::class, 'getPelayan']);

//Router Kamar

Route ::get('/kamar', [KamarController::class, 'index']);
Route ::get('/category', [CategoryController::class, 'index']);

Route :: middleware('auth:pelanggan')->group(function () {

    Route ::post('/kamar', [KamarController::class, 'store']);
    Route ::patch('/kamar/{id}', [KamarController::class, 'update']);
    Route ::delete('/kamar/{id}', [KamarController::class, 'destroy']);

    
    //Router Category
    Route ::post ('/addcategory', [CategoryController::class, 'store']);
    Route ::patch ('/category/{id}', [CategoryController::class, 'update']);
    Route ::delete ('/category/{id}', [CategoryController::class, 'destroy']);

    Route ::get('/transaksi', [TransaksiController::class,'index']);
    Route ::patch ('/transaksi/{id}', [TransaksiController::class, 'update']);
    Route ::post('/transaksi', [TransaksiController::class, 'store']);
    Route ::delete ('/transaksi/{id}', [TransaksiController::class, 'destroy']);
});
