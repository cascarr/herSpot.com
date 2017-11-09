<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

Let's tell Laravel the URIs it should respond to and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('index');
});


Route::get('list', 'MemberController@index');
Route::post('add', 'MemberController@store');

Route::get('edit/{id}', 'MemberController@edit');
Route::post('edit/{id}', 'MemberController@update');

Route::delete('delete/{id}', 'MemberController@destroy');


//Route::resource('members', 'MemberController'); => Should use this