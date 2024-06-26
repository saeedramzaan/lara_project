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

// Route URL Name API has been changed as MAPI 

Route::post('/create', [ModuleController::class, 'create']);

Route::post('/getQuizInfo', [ModuleController::class, 'quizInfo']);

Route::post('/getSpecQuiz', [ModuleController::class, 'specQuiz']);

Route::get('/module', [ModuleController::class, 'index']);

Route::get('/quiz', [ModuleController::class, 'create']);

Route::post('/ans', [ModuleController::class, 'answer']);

Route::post('/loadVerses', [ModuleController::class, 'verses']);

Route::post('/getWords',[ModuleController::class, 'words']);

Route::post('/store', [ModuleController::class, 'store']);

Route::get('/listSurah',[ModuleController::class, 'listSurah']);

Route::post('/listLastVerse',[ModuleController::class, 'listLastVerse']);

Route::post('/search',[ModuleController::class, 'searchWord']);

Route::post('/update',[ModuleController::class,'update']);


Route::get('/url/user', function () {
    // return 'test data';
     return redirect()->route('newapi.module');
})->name('api-mobile.user');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
