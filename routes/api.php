<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\inboxController;
use App\Http\Controllers\messagingController;
use App\Http\Controllers\productController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register',[authController::class,'register'])->name('register');
Route::post('/login',[authController::class,'login'])->name('login');
Route::post('/upload',[productController::class,'store'])->name('upload-picture');
Route::get('/showProducts',[productController::class,'show'])->name('show-products');
Route::get('/message',[messagingController::class,'show'])->name('message');
Route::post('/sendMessage',[messagingController::class,'store']);
Route::get('/inbox',[inboxController::class, 'show']);
Route::post('/select_conv_id',[inboxController::class,'store'])->name('select-id');
Route::post('/removeProduct',[productController::class, 'destroy'])->name('remove-product');
