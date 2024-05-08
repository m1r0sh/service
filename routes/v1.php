<?php

use App\CompanyService\Auth\Action\JsonResponders\AuthAction;
use App\CompanyService\Auth\Action\JsonResponders\LogoutAction;
use App\CompanyService\Auth\Action\JsonResponders\RefreshAction;

use App\CompanyService\Auth\Action\JsonResponders\RegistrationAction;
use App\CompanyService\Note\Action\JsonResponders\AddAction;
use App\CompanyService\Note\Action\JsonResponders\DeleteAction;
use App\CompanyService\Note\Action\JsonResponders\ListAction;
use App\CompanyService\Note\Action\JsonResponders\ShowAction;
use App\CompanyService\Note\Action\JsonResponders\UpdateAction;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ExecutorController;
use App\Http\Controllers\ServiceAction\MylistAction;
use App\Http\Controllers\ServiceAction\SuccessAction;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceTypeController;
use Illuminate\Support\Facades\Route;


Route::post('register', RegistrationAction::class);
Route::post('login',AuthAction::class);
Route::post('refresh',RefreshAction::class)->middleware('jwt');

Route::group([
    'middleware' => ['api', 'jwt'],
    'prefix' => 'auth'
], function () {
    Route::post('logout',LogoutAction::class);
});

Route::group([
    'middleware' => ['api', 'jwt'],
], function () {

    Route::group([
        'prefix' => 'notes'
    ], function () {
        Route::get('/list', ListAction::class);
        Route::get('/{id}', ShowAction::class);
        Route::post('/add', AddAction::class);
        Route::put('/update/{id}', UpdateAction::class);
        Route::delete('/delete/{id}', DeleteAction::class);
    });

    ////////////////////
    /// //////////////



//    Route::group([
//        'prefix' => 'services'
//    ], function () {
//        Route::resource('services', ServiceController::class);
//    });
//
//    Route::group([
//        'prefix' => 'attributes'
//    ], function () {
//        Route::resource('attributes', AttributeController::class);
//    });
//
//    Route::group([
//        'prefix' => 'servicetypes'
//    ], function () {
//        Route::resource('servicetypes', ServiceTypeController::class);
//    });
//
//    Route::group([
//        'prefix' => 'executors'
//    ], function () {
//        Route::resource('executors', ExecutorController::class);
//    });
});


