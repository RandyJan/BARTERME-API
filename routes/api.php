<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\authController;
use App\Http\Controllers\graphController;
use App\Http\Controllers\inboxController;
use App\Http\Controllers\messagingController;
use App\Http\Controllers\productController;
use App\Http\Controllers\ratingController;
use App\Http\Controllers\reportController;
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
Route::post('/message',[messagingController::class,'show'])->name('message');
Route::post('/sendMessage',[messagingController::class,'store']);
Route::get('/inbox',[inboxController::class, 'show']);
Route::post('/select_conv_id',[inboxController::class,'store'])->name('select-id');
Route::post('/removeProduct',[productController::class, 'destroy'])->name('remove-product');
Route::post('/bundle',[productController::class, 'bundle']);
Route::post('/getbundle',[productController::class,'getbundle']);
Route::post('/trade', [productController::class, 'updatedStatus']);
Route::post('/rate',[ratingController::class, 'store']);
Route::post('/computeRating',[ratingController::class,'show']);
Route::post('/sendReport',[reportController::class, 'sendReport']);
Route::get('/getReports',[reportController::class,'getReports']);
Route::post('/deleteProduct', [productController::class, 'deleteProduct']);
Route::get('/getRating',[ratingController::class, 'getRating']);
//admin side
Route::post('/blockUser',[adminController::class, 'blockUser']);
Route::get('/blacklisted',[adminController::class,'getBlacklisted']);
Route::get('/computeCategories', [graphController::class, 'computeCategories']);
Route::get('/computeBarteredGoods', [graphController::class, 'computeBarteredGoods']);