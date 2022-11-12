<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AnimalController;


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

#methode get
Route::get('/animals', [AnimalController::class, 'index']);


#methode post
Route::post('/animals', [AnimalController::class, 'store']);
#methode put
Route::put('/animals/{id}', [AnimalController::class, 'update']);

#methode delete
Route::delete('/animals/{id}', [AnimalController::class, 'destroy']);

#membuat route students dengan methode get
Route::get('/students', [StudentController::class, 'index']);
#membuat route students dengan methode post
Route::post('/students', [StudentController::class, 'store']);
#methode put
Route::put('/students/{id}', [StudentController::class, 'update']);
#methode delete
Route::delete('/students/{id}', [StudentController::class, 'destroy']);
#methode get
Route::get('/students/{id}', [StudentController::class, 'show']);