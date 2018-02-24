<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
Route::get('pedidos',  'DetalleController@pedidos');
Route::get('buscar',  'BuscarController@buscar');
Route::get('venta',  'DetalleController@venta');
Route::get('imagen',  'DetalleController@imagen');
Route::resource('detalles','DetalleController');
Route::resource('cal', 'gCalendarController');
Route::get('oauth', 'gCalendarController@oauth')->name('oauthCallback');