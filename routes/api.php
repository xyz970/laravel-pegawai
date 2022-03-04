<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeFeesController;
use App\Http\Controllers\SellerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Traits\ApiResponse;
use App\Http\Middleware\SellerCheck;
use App\Models\EmployeeFees;

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

Route::group(['prefix'=>'pegawai'],function(){
    Route::get('/',[EmployeeController::class,'index']);
    Route::put('/put/{id}',[EmployeeController::class,'insertPut']);
    Route::post('/post',[EmployeeController::class,'insertPost']);
    Route::get('/{id}/detail',[EmployeeController::class,'detail']);
});

Route::group(['prefix'=>'gaji'],function(){
    Route::get('/bayar/{id}',[EmployeeFeesController::class,'index']);
    Route::post('/bayar/batch',[EmployeeFeesController::class,'batchUpdate']);
});

// Route::prefix('mystore')->middleware('AuthCheck')->group(function(){
//     Route::get('/',[SellerController::class,'check']);
//     Route::post('settings/update',[SellerController::class,'settings']);
// });
