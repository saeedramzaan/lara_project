<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/create', [ModuleController::class, 'create']);

Route::post('/ans', [ModuleController::class, 'answer']);

Route::get('/', function () {
    return view('welcome');
});



Route::get('/test', function () {
    return view('welcome');
});


