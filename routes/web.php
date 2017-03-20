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

// Home
Route::get('/', function () {
    return view('home');
});

// Contact Us
Route::get('contact', function () {
	return view('contact');
});


/*Route::get('/db', function(){
	return App\Session::all();
	//return DB::select('show tables;');
});*/

// Products
Route::resource('product', 'ProductController');
// Life Counter
Route::resource('life', 'LifeCounter');
//Shopping Cart
Route::resource('cart', 'CartController');

//Route::get('life', 'LifeCounter@index');

//Route::post('/createSession', 'LifeCounter@create');

Route::post('/checkSession', function(){
	session_start();
	if(isset($_SESSION['session'])){
		unset($_SESSION['session']);
	}

	if(Request::ajax()){
		$session = App\Session::select('sessionID', 'password')
							->where('sessionID', $_POST['id'])
							->get();
		
		
	    $_SESSION['session'] = $_POST['id'];
	
		return url('life');
	}
});
