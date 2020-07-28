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
Route::post('add','Userscontroller@add'); ///post add
Route::get('user/{id}/edit', 'Userscontroller@edit');
Route::put('user/{id}/update', 'Userscontroller@update'); //put update
Route::get('user/{id}/view', 'Userscontroller@view'); ///get view
Route::delete('user/{id}/delete', 'Userscontroller@delete');///  delete delete
Route::get('user/{id}/edit', 'Userscontroller@edit');





Route::get('api/user','apicontroller@list');

Route::post('api/user','apicontroller@add');

Route::get('api/user/{id}', 'apicontroller@edit');

Route::put('api/user', 'apicontroller@update');

Route::delete('api/user', 'apicontroller@delete');///  delete delete







Route::get('api/user/view/{id}', 'apicontroller@view'); 

Route::post('api/user/update1', 'apicontroller@update1');///  delete delete