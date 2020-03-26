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
Route::get('/goods',"GoodsController@goods");
Route::any('/create',"BrandController@create");
Route::any('/store',"BrandController@store");
Route::any('/index',"BrandController@index");
Route::any('/edit/{id}',"BrandController@edit");
Route::any('/destroy/{id}',"BrandController@destroy");
Route::any('/update/{id}',"BrandController@update");
Route::any('/catecreate',"CateController@catecreate");
Route::any('/catestore',"CateController@catestore");
Route::any('/cateindex',"CateController@cateindex");
Route::any('/cateedit/{id}',"CateController@cateedit");
Route::any('/cateupdate/{id}',"CateController@cateupdate");
Route::any('/catedestroy/{id}',"CateController@catedestroy");
Route::any('/homecreate',"HomeController@homecreate");
Route::any('/home_index',"HomeController@home_index");
Route::any('/homestore',"HomeController@homestore");
Route::prefix('/goods')->middleware('islogin')->group(function(){
	Route::any('/create',"GoodsController@create");
	Route::any('/store',"GoodsController@store");
	Route::any('/index',"GoodsController@index");
	Route::any('/destroy/{id}',"GoodsController@destroy");
	Route::any('/edit/{id}',"GoodsController@edit");
	Route::any('/update/{id}',"GoodsController@update");
});
Route::prefix('/book')->group(function(){
	Route::any('/create',"BookController@create");
	Route::any('/store',"BookController@store");
	Route::any('/index',"BookController@index");
});
Route::prefix('/admin')->group(function(){
	Route::get('/create',"AdminController@create");
	Route::post('/store',"AdminController@store");
	Route::get('/index',"AdminController@index");
	Route::get('/edit/{id}',"AdminController@edit");
	Route::get('/destroy/{id}',"AdminController@destroy");
	Route::post('/update/{id}',"AdminController@update");
});
Route::any('/new/create',"NewController@create");
Route::any('/new/store',"NewController@store");
Route::any('/new/index',"NewController@index");
Route::get('/login/create',"LoginController@create");
Route::post('/login/store',"LoginController@store");
Route::get('/login/index',"LoginController@index");
Route::prefix('/text')->middleware('islogin')->group(function(){
Route::get('/create',"TextController@create");
	Route::post('/store',"TextController@store");
	Route::get('/index',"TextController@index");
	Route::get('/destroy/{id}',"TextController@destroy");
	Route::get('/edit/{id}',"TextController@edit");
	Route::post('/update/{id}',"TextController@update");
});
Route::get('/',"Index\IndexController@index");
Route::get('/log',"Index\LoginqController@log");
Route::get('/reg',"Index\LoginqController@reg");
Route::get('/reg/send',"Index\LoginqController@send");
Route::post('/login/logdo',"Index\LoginqController@logdo");
Route::post('/login/regdo',"Index\LoginqController@regdo");
Route::get('/sendemail',"Index\LoginqController@sendemail");
Route::get('/pid/{id}',"Index\IndexController@pid");
Route::get('/proinfo/{id}',"Index\IndexController@proinfo");
Route::get('/cart',"Index\IndexController@cart");
Route::get('/cartlist',"Index\IndexController@cartlist");
Route::get('/rexiaoji',"Index\IndexController@rexiaoji");
Route::get('/getRxiaoji',"Index\IndexController@getRxiaoji");
Route::get('/getTotall',"Index\IndexController@getTotall");
Route::get('/buy/{id}',"Index\IndexController@buy");
Route::get('/tuichu',"Index\LoginqController@tuichu");
Route::get('/address',"Index\IndexController@address");
Route::get('/order',"Index\IndexController@order");
Route::get('/order_buy/{id}',"Index\IndexController@order_buy");
Route::get('/order_success',"Index\IndexController@order_success");
Route::get('/return_url',"Index\IndexController@return_url");
Route::post('/notify_url',"Index\IndexController@notify_url");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('/test')->group(function(){
	Route::get('/index', 'TestController@index');
	Route::post('/store', 'TestController@store');
	Route::get('/show', 'TestController@show');

});
