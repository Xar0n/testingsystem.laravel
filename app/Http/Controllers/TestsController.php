<?php

namespace App\Http\Controllers;

use App\Scheduled_Test;
use App\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Variant_Question;
use App\Question;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{
    public function index(Request $request)
	{
		$tests = [];
		$group_id = Auth::user()->group_id;
		$tests_s = Scheduled_Test::where('group_id', $group_id)->get();
		foreach ($tests_s as $test_s)
		{
			$test = Test::findOrFail($test_s->test_id);
			$test->id = $test_s->id;
			$tests[] =  $test;
		}
		var_dump($request->session()->get('test_s.id'));
		return view('tests', ['tests' => $tests, 'date' => Carbon::now()->format('H:i')]);
	}

	public  function show($test_s_id)
	{
		$test_s = Scheduled_Test::findOrFail($test_s_id);
		$test = Test::findOrFail($test_s->test_id);
		/*if ($test->date <= Carbon::now()){
			return view('test', ['test' => $test]);
		}
		else
		{
			$date = strtotime($test->date) - strtotime(Carbon::now());
			return 'Тест будет доступен через: '.date('d:H:i:s ',$date);
		}*/
		return view('test', ['test' => $test, 'test_s' => $test_s]);
	}

	public function run(Request $request, $test_s_id)
	{
		$test_s = Scheduled_Test::findOrFail($test_s_id);
		$test = Test::findOrFail($test_s->test_id);
		$questions = Question::where('test_id', $test->id)->get();
		$variants = [];
		foreach ($questions as $question) {
			if ($question->type == 2) {
				$variants[$question->id] = Variant_Question::where('question_id', $question->id)->get();
			}
		}
		$request->session()->push('test_s.id', $test_s_id);
		return view('test_questions', ['questions' => $questions, 'variants' => $variants, 'test' => $test]);
	}
}
