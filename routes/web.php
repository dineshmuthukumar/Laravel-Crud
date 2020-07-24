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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','Userscontroller@home');
Route::get('create','Userscontroller@create');
Route::post('add','Userscontroller@add');
Route::get('user/{id}/edit', 'Userscontroller@edit');
Route::put('user/{id}/update', 'Userscontroller@update');
Route::get('user/{id}/view', 'Userscontroller@view');
Route::delete('user/{id}/delete', 'Userscontroller@delete');
Route::get('user/{id}/edit', 'Userscontroller@edit');

Route::get('api/user/list','apicontroller@list');
Route::post('api/user/add','apicontroller@add');

Route::get('api/user/edit/{id}', 'apicontroller@edit');
Route::post('api/user/update', 'apicontroller@update');