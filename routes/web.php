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
use App\Session;
use App\Admin;

// Home
Route::get('/', function () {
    return view('home');
});

Route::get('/reset', function(){
	session()->forget('loggedin');
	return back();
});
// Contact Us
Route::get('contact', function () {
	return view('contact');
});

Route::get('/sessionRefresh', function(){
	session()->flush();
});
/*Route::get('/db', function(){
	return DB::select('show tables;');
});*/

// Products
Route::post('product/search', 'ProductController@search')->name('product.search');
Route::resource('product', 'ProductController');

Route::post('product/checkUser', function(){
	$admin = Admin::where('adminName', $_POST['name'])
		->where('adminPassword', $_POST['password'])
		->first();
	
	if(!is_null($admin)){
		session()->put('loggedin', true);

		return "Success";
	}
	return "incorrect";
});

// Life Counter
Route::post('life/newGame', 'LifeCounter@newGame')->name('life.newgame');
Route::resource('life', 'LifeCounter');

//Shopping Cart
Route::resource('cart', 'CartController');
Route::resource('receipt', 'ReceiptController');

Route::post('/checkSession', function(){
	session_start();
	if(isset($_SESSION['session'])){
		unset($_SESSION['session']);
	}

	if(Request::ajax()){
		$session = App\Session::select('sessionID', 'password')
							->where('sessionID', $_POST['id'])
							->where('password', $_POST['pass'])
							->first();
	
		if(!is_null($session)){
	    	$_SESSION['session'] = $_POST['id'];
			return url('life');
		}
		return "incorrect";
	}
});

