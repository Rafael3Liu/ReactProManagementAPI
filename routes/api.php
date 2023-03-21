<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//public routes
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/products',[ProductController::class,'index']);

Route::get('/products/{id}',[ProductController::class,'show']);


Route::put('/products/{id}',[ProductController::class,'update']);


//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/products',[ProductController::class,'store']);
    Route::get('/search/{title}',[ProductController::class,'search']);
    Route::delete('/products/{id}',[ProductController::class,'destroy']);

    Route::post('/logout',[AuthController::class,'logout']);
});





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

