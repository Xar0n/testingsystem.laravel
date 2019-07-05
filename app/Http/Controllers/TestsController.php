<?php

namespace App\Http\Controllers;

use App\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Variant_Question;
use App\Question;
class TestsController extends Controller
{
    public function index()
	{
		$tests = \App\Test::orderBy('id')->get();
		return view('tests', ['tests' => $tests]);
	}

	public  function show($test_id)
	{
		$test = Test::findOrFail($test_id);
		if ($test->date <= Carbon::now()){
			return view('test', ['test' => $test]);
		}
		else return 'Тест будет доступен:'.$test->date->year. ' '.$test->time;
	}

	public function run(Request $request, $test_id)
	{
		$questions = Question::where('test', $test_id)->get();
		$variants = [];
		foreach ($questions as $question) {
			if ($question->type == 1) {
				$variants[$question->id] = Variant_Question::where('question', $question->id)->get();
			}
		}
		$request->session()->push('test.id', $test_id);
		return view('test_questions', ['questions' => $questions, 'variants' => $variants]);
	}
}
