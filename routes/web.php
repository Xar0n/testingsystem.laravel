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

use App\Question;
use App\Result;



Route::get('/auth', function () {
	return view('auth');
});



Route::group(['middleware' => 'auth'], function () {
	Route::get('/test/{test}/', function (\App\Test $test) {
		return view('test', ['test' => $test]);
	});

	Route::post('/test/{test}/', function ($test_id) {
		$questions = Question::where('test', $test_id)->get();
		return view('test_questions', ['questions' => $questions]);
	});

	Route::get('/result/{result}/', function (\App\Result $result) {
		return 'Результат теста';
	});

	Route::get('/profile', function () {
		return view('profile');
	});

	Route::get('/', function () {
		$tests = \App\Test::orderBy('id')->get();
		return view('tests', ['tests' => $tests]);
	});
});

Auth::routes();

Route::get('/home', 'HomeController@index');
