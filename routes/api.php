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

Route::post('/renderQuestion', [ModuleController::class, 'renderQuestion']);

Route::post('/getQuizInfo', [ModuleController::class, 'quizInfo']);

Route::post('/getSpecQuiz', [ModuleController::class, 'specQuiz']);

Route::get('/module', [ModuleController::class, 'index']);

Route::get('/quiz', [ModuleController::class, 'create']);

Route::post('/ans', [ModuleController::class, 'answer']);

Route::post('/verbAns', [ModuleController::class, 'verbAnswer']);

Route::post('/loadVerses', [ModuleController::class, 'verses']);

Route::post('/loadVerb', [ModuleController::class, 'loadVerbs']);

Route::post('/getWords',[ModuleController::class, 'words']);

Route::post('/store', [ModuleController::class, 'store']);

Route::post('/storeVerb', [ModuleController::class, 'storeVerb']);

Route::get('/listSurah',[ModuleController::class, 'listSurah']);

Route::post('/listLastVerse',[ModuleController::class, 'listLastVerse']);

Route::post('/listLastVerb',[ModuleController::class, 'listLastVerb']);

Route::post('/search',[ModuleController::class, 'searchWord']);

Route::post('/searchVerb',[ModuleController::class, 'searchVerb']);

Route::post('/update',[ModuleController::class,'update']);

Route::post('/updateVerb',[ModuleController::class,'updateVerb']);


Route::get('/url/user', function () {
    // return 'test data';
     return redirect()->route('newapi.module');
})->name('api-mobile.user');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
