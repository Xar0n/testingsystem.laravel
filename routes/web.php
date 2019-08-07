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

Route::group(['prefix' => '/admin_panel', 'middleware' => 'admin', 'namespace' => 'Admin'],function () {
	Route::get('/', function (){
		return view('admin.index');
	});

	Route::group(['prefix' => '/users'], function (){

	});

	Route::group(['prefix' => '/tests'], function (){
		Route::group(['prefix' => '/questions'], function () {
			Route::post('/add_form/{test}', 'QuestionsController@showForm');
		});
		Route::get('/', 'TestsController@showAll');
		Route::post('/', 'TestsController@showOne');
		Route::get('/add', 'TestsController@showFormAdd');
		Route::post('/add', 'TestsController@add');
		Route::get('/delete/{test}/', 'TestsController@delete');
		Route::get('/edit/{test}/', 'TestsController@showFormEdit');
		Route::post('/edit/{test}/', 'TestsController@edit');
	});

	Route::group(['prefix' => '/groups'], function (){
		Route::get('/', 'GroupsController@showAll');
		Route::post('/', 'GroupsController@showOne');
		Route::get('/add', 'GroupsController@showFormAdd');
		Route::post('/add', 'GroupsController@add');
		Route::get('/delete/{group}/', 'GroupsController@delete');
		Route::get('/edit/{group}/', 'GroupsController@showFormEdit');
		Route::post('/edit/{group}/', 'GroupsController@edit');
		Route::group(['prefix' => '/scheduled_tests'], function (){
			Route::get('/{group}/add/{test}', 'ScheduledTestController@showFormAdd');
			Route::post('/{group}/add/{test}', 'ScheduledTestController@add');
			Route::get('/edit/{test_s}', 'ScheduledTestController@showFormEdit');
			Route::post('/edit/{test_s}', 'ScheduledTestController@edit');
			Route::get('/delete/{test_s}', 'ScheduledTestController@delete');
			Route::get('/{group}', 'ScheduledTestController@showAll');
			Route::post('/{group}', 'ScheduledTestController@showOne');
		});
	});
});

Route::group(['middleware' => ['web'], 'namespace' => 'Auth'], function() {
	Route::get('login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
	Route::post('login', ['as' => 'login.post', 'uses' => 'LoginController@login']);
	Route::post('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
	Route::get('register', ['as' => 'register', 'uses' => 'RegisterController@showRegistrationForm']);
	Route::post('register', ['as' => 'register.post', 'uses' => 'RegisterController@register']);
});

