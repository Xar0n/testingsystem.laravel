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

use Illuminate\Http\Request;


Route::get('/auth', function () {
	return view('auth');
});


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', 'TestsController@index');

	Route::get('/test/{test}/', 'TestsController@show');

	Route::post('/test/{test}/', 'TestsController@run');

	Route::get('/result/{result}/', function (\App\Result $result) {
		return 'Результат теста';
	});

	Route::post('/result', function (Request $request) {
		if ($request->isMethod('post')) {
			$test_id = session('test.id');
			Session::forget('test.id');
			$questions = Question::where('test', '=', $test_id)->get();
			$test = Test::findOrFail($test_id);
			$points = 0;
			$points_total = 0;
			foreach ($questions as $question)
			{
				$points_total = $points_total + $question->points;
				if ($question->true_answer == $request->input($question->id))
				{
					$points = $points + $question->points;
				}
			}
			return view('result', ['points' => $points, 'points_total' => $points_total, 'test' => $test]);
		}
	});

	Route::get('/profile', function () {
		return view('profile');
	});


});

Auth::routes();

