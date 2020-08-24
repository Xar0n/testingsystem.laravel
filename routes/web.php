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
use Symfony\Component\HttpFoundation\Request;

Route::group(['middleware' => 'auth'], function () {
	Route::group(['middleware' => 'deleteTestSId'], function () {
		Route::get('/', 'TestsController@index');
		Route::get('/profile', 'ResultsController@getResults');
});
	Route::group(['middleware' => 'allowTest'], function () {
		Route::get('/test/{test_s}/', 'TestsController@show');
		Route::match(['get', 'post'],'/test/do/{test_s}/', 'TestsController@run');
	});
	Route::post('/result', 'ResultsController@index');
	Route::get('/result/{result}/', function (\App\Result $result) {
		return 'Результат теста';
	});
});

Route::group(['prefix' => '/admin_panel', 'middleware' => 'admin', 'namespace' => 'Admin'],function () {
	Route::get('/', 'ResultsController@showForm');
	Route::get('/get_tests', 'ResultsController@getScheduledTests');
	Route::match(['get', 'post'], '/results', 'ResultsController@showResults');
	Route::group(['prefix' => '/results'], function () {
		Route::get('/delete/{result}', 'ResultsController@delete');
		Route::get('/show/{result}', 'ResultsController@showResult');
	});

	Route::group(['prefix' => '/users'], function (){
		Route::get('/', 'UsersController@showAll');
		Route::post('/', 'UsersController@showOne');
		Route::get('/add', 'UsersController@showFormAdd');
		Route::post('/add', 'UsersController@add');
		Route::get('/delete/{test}/', 'UsersController@delete');
		Route::get('/edit/{test}/', 'UsersController@showFormEdit');
		Route::post('/edit/{test}/', 'UsersController@edit');
	});

	Route::group(['prefix' => '/tests'], function (){
		Route::group(['prefix' => '/questions'], function () {
			Route::post('/add_form/{test}', 'QuestionsController@showForm');
			Route::post('/add/{test}', 'QuestionsController@add');
			Route::get('/{test}', 'QuestionsController@showAll');
			Route::get('/edit/{question}', 'QuestionsController@showFormEdit');
			Route::post('/edit/{question}', 'QuestionsController@edit');
			Route::get('/delete/{question}', 'QuestionsController@delete');
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
		Route::get('/show/{group}', 'GroupsController@showUsers');
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
});

