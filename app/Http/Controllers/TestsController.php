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
		else
		{
			$date = strtotime($test->date) - strtotime(Carbon::now());
			return 'Тест будет доступен через: '.date('d:H:i:s ',$date);
		}

	}

	public function run(Request $request, $test_id)
	{
		$test = Test::findOrFail($test_id);
		$questions = Question::where('test', $test_id)->get();
		$variants = [];
		foreach ($questions as $question) {
			if ($question->type == 1) {
				$variants[$question->id] = Variant_Question::where('question', $question->id)->get();
			}
		}
		$request->session()->push('test.id', $test_id);
		$date = (strtotime($test->date) + strtotime($test->time)) - strtotime(Carbon::now());
		return view('test_questions', ['questions' => $questions, 'variants' => $variants, 'time' => $date]);
	}
}
