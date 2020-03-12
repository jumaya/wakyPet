<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


Route::get('/mascota', 'MascotaController@index')->name('mascota');

Route::get('/mascota/new', 'MascotaController@create')->name('new_mascota');

Route::post('storePet','MascotaController@store')->name('storePet');

Route::get('/mascota/{id}/edit','MascotaController@edit');

Route::post('/mascota/update','MascotaController@update');

Route::post('/mascota/delete/{id}','MascotaController@delete');

Route::get('/plan', 'PlanController@index')->name('plan');


Route::get('/programacion', 'ProgramacionController@index')->name('programacion');

Route::post('/programacion/store','ProgramacionController@store')->name('storeProg');

Route::post('/programacion/update','ProgramacionController@update')->name('updateProg');

Route::post('/programacion/delete','ProgramacionController@destroy')->name('deleteProg');


Route::get('/getClient', 'AppiController@getClient');

Route::get('/getMascota', 'AppiController@getMascota');

Route::get('/getRaza', 'AppiController@getRaza');

Route::get('/getProgramacion', 'AppiController@getProgramacion');

Route::post('/saveMascota','AppiController@saveMascota');

Route::get('/getNameMascota','AppiController@getNameMascota');

Route::get('/getPlan','AppiController@getPlan');

Route::post('/saveProgPaseo','AppiController@saveProgPaseo');
