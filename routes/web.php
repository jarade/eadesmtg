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

// index
Route::get('/', function () {
    return view('child');
});

// Contact Us
Route::get('contact', function () {
	return view('contact');
});

Route::get('product', 'product@index');

Route::get('/db', function(){
	return DB::select('show tables;');
});