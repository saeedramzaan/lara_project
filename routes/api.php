<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;

 

/*
|--------------------------------------------------------------------------
|  Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/module', [ModuleController::class, 'index']);

Route::get('/quiz', [ModuleController::class, 'create']);

Route::get('/url/user', function () {
     return 'test dataa';
})->name('api-mobile.user');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
