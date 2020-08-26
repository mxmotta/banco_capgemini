<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/accounts', 'AccountsController@index')->name('accounts.index');
Route::get('/accounts/{id}', 'AccountsController@view')->name('accounts.view');
Route::post('/accounts', 'AccountsController@store')->name('accounts.store');
Route::get('/accounts/{id}/balance', 'AccountsController@balance')->name('accounts.balance');


Route::get('/accounts/{id}/movements', 'MovementsController@index')->name('accounts.movements.index');
Route::get('/accounts/{id}/movements/deposits', 'MovementsController@deposits')->name('accounts.movements.deposits');
Route::get('/accounts/{id}/movements/withdraws', 'MovementsController@withdraws')->name('accounts.movements.withdraws');
Route::get('/accounts/{id}/movements/{movement_id}', 'MovementsController@view')->name('accounts.movements.view');
Route::post('/accounts/{id}/movements', 'MovementsController@store')->name('accounts.movements.store');
