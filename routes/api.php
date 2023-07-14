<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ExecutorController;
use App\Http\Controllers\JwtAuth\RegisterAction;
use App\Http\Controllers\ServiceAction\MylistAction;
use App\Http\Controllers\ServiceAction\SuccessAction;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JwtAuth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', RegisterAction::class);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login',[AuthController::class, 'login'])->name('login');
    Route::post('logout',[AuthController::class, 'logout']);
    Route::post('refresh',[AuthController::class, 'refresh']);
    Route::post('me',[AuthController::class, 'me']);


    Route::resource('services', ServiceController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('servicetypes', ServiceTypeController::class);
    Route::resource('executors', ExecutorController::class);

    Route::get('/mylist', MylistAction::class);
    Route::get('/status/{id}', SuccessAction::class);
    Route::get('/exelist', \App\Http\Controllers\Executor\MylistAction::class);

});
