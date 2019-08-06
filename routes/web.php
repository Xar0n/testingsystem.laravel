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

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::get('/auth', function () {
	return view('auth');
});


Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'TestsController@index');
	Route::get('/test/{test}/', 'TestsController@show');
	Route::match(['get', 'post'],'/test/do/{test}/', 'TestsController@run');
	Route::get('/result/{result}/', function (\App\Result $result) {
		return 'Результат теста';
	});
	Route::post('/result', 'ResultsController@index');
	Route::get('/profile', function () {
		return view('profile');
	});
});

Route::group(['prefix' => '/admin_panel', 'middleware' => 'admin'],function () {
	Route::get('/', function (){
		return view('admin.index');
	});

	Route::group(['prefix' => '/users'], function (){

	});

	Route::group(['prefix' => '/tests'], function (){
		Route::get('/', 'Admin\TestsController@showAll');
		Route::post('/', 'Admin\TestsController@showOne');
		Route::get('/add', 'Admin\TestsController@showFormAdd');
		Route::post('/add', 'Admin\TestsController@add');
		Route::get('/delete/{test}/', 'Admin\TestsController@delete');
		Route::get('/edit/{test}/', 'Admin\TestsController@showFormEdit');
		Route::post('/edit/{test}/', 'Admin\TestsController@edit');
	});

	Route::group(['prefix' => '/groups'], function (){
		Route::get('/', 'Admin\GroupsController@showAll');
		Route::post('/', 'Admin\GroupsController@showOne');
		Route::get('/add', 'Admin\GroupsController@showFormAdd');
		Route::post('/add', 'Admin\GroupsController@add');
		Route::get('/delete/{group}/', 'Admin\GroupsController@delete');
		Route::get('/edit/{group}/', 'Admin\GroupsController@showFormEdit');
		Route::post('/edit/{group}/', 'Admin\GroupsController@edit');
	});
});

Route::group(['middleware' => ['web']], function() {
	Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
	Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
	Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
	Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
	Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);
});

