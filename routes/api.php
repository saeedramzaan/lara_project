<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\AuthController;
 

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

Route::post('/chapterTestt', [ModuleController::class,'chapterTest']);

Route::post('/renderQuestion', [ModuleController::class, 'renderQuestion']); // verbTable

Route::post('/getQuizInfo', [ModuleController::class, 'quizInfo']);

Route::post('/getSpecQuiz', [ModuleController::class, 'specQuiz']);

Route::get('/module', [ModuleController::class, 'index']);

Route::get('/quiz', [ModuleController::class, 'create']);

Route::post('/ans', [ModuleController::class, 'answer']);

Route::post('/verbAns', [ModuleController::class, 'verbAnswer']);

Route::post('/loadVerses', [ModuleController::class, 'verses']);

Route::post('/verseList', [ModuleController::class, 'verseList']);

Route::post('/alist', [ModuleController::class, 'alphabetList']);

Route::get('/listWordNo', [ModuleController::class, 'listWordNo']);

Route::post('/chapterList', [ModuleController::class,'chapterList']);

Route::post('/chapterTes', [ModuleController::class,'chapterTest']);

Route::post('/listQuizNo', [ModuleController::class, 'listQuizNo']);

// Route::get('/listQuizNo', [ModuleController::class, 'listQuizNo']);

Route::post('/verbDropdown', [ModuleController::class, 'verbDropdown']);

Route::post('/loadVerb', [ModuleController::class, 'loadVerbs']);

Route::post('/getWords',[ModuleController::class, 'words']);

Route::post('/store', [ModuleController::class, 'store']);

Route::post('/storeVerb', [ModuleController::class, 'storeVerb']);

Route::post('/engStore', [ModuleController::class, 'englishStore']);

Route::post('/listSurah',[ModuleController::class, 'listSurah']);

Route::post('/listLastVerse',[ModuleController::class, 'listLastVerse']);

Route::post('/listLastVerb',[ModuleController::class, 'listLastVerb']);

Route::post('/listLastEngWord',[ModuleController::class, 'listLastEnglishWord']);

Route::post('/categoryList', [ModuleController::class,'categoryList']);

Route::post('/search',[ModuleController::class, 'searchWord']);

Route::post('/searchVerb',[ModuleController::class, 'searchVerb']);

Route::post('/searchEng',[ModuleController::class, 'searchEngWord']);

Route::post('/update',[ModuleController::class,'update']);

Route::post('/engUpdate',[ModuleController::class,'englishUpdate']);

// Route::get('/updateVerb',[ModuleController::class,'updateVerb']);

Route::post('/updateVerb',[ModuleController::class,'updateVerb']);

Route::get('/testurl', [ModuleController::class,'testClass']);

Route::post('/alist', [ModuleController::class, 'alphabetList']);


Route::get('/url/user', function () {
    // return 'test data';
     return redirect()->route('newapi.module');
})->name('api-mobile.user');

Route::post('/login', [AuthController::class, 'login']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   
//     return $request->user();
// });
    

Route::middleware('auth:sanctum')->group(function (){

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request){
        return $request->user();
    });

   // return $request->user();
});



    
