<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\ResearcherController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\Reminder_linesController;

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


Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::apiResource('dossiers', 'DossierController');
    Route::apiResource('statues', 'StatueController');
    Route::post('/switchPhases', 'DossierController@switchReminder_line_type')->name('switchPhases');        
    Route::post('/arret/{id}', 'DossierController@arret')->name('arretDossier');        
    Route::apiResource('departements', 'DepartementController');
    Route::apiResource('files', 'FileController');
    Route::apiResource('researchers', 'ResearcherController');
    Route::apiResource('reminder_lines', 'Reminder_linesController');
    Route::get('/logout', 'UserController@logout');
});

// Route::get('/mail', 'MailController@mailing');
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
