<?php

namespace App\Http\Controllers;

use App\Performed_Test;
use App\Scheduled_Test;
use App\Test;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Variant_Question;
use App\Question;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{
	protected function allow(Scheduled_Test $test_s)
	{
		//try {
			$p_test = Performed_Test::where([['scheduled_test_id', $test_s->id], ['user_id', Auth::user()->id]])->get()[0];
			if(!isset($p_test)) abort(404);
			$date = strtotime($p_test->date_time) + strtotime($test_s->time);
			echo date('Y-m-d H:i:s',$date);
			echo ' '.Carbon::now();
			if (date($date) < Carbon::now())
			{
				echo 'Время истекло';
				abort(404);
			} else {
				return ($p_test->date_time + $test_s->time) - Carbon::now();
			}

		/*} catch (\Exception $exception) {
			$p_test = new Performed_Test;
			$p_test->scheduled_test_id = $test_s->id;
			$p_test->user_id = Auth::user()->id;
			$p_test->date_time = Carbon::now();
			$p_test->save();
			return $test_s->time;
		}*/
	}

    public function index()
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
		return view('tests', ['tests' => $tests, 'date' => Carbon::now()]);
	}

	public  function show($test_s_id)
	{
		$test_s = Scheduled_Test::findOrFail($test_s_id);
		$test = Test::findOrFail($test_s->test_id);
		return view('test', ['test' => $test, 'test_s' => $test_s]);
	}

	public function run($test_s_id)
	{
		$test_s = Scheduled_Test::findOrFail($test_s_id);
		$time = $this->allow($test_s);
		$test = Test::findOrFail($test_s->test_id);
		$questions = Question::where('test_id', $test->id)->get();
		$variants = [];
		foreach ($questions as $question) {
			if ($question->type == 2) {
				$variants[$question->id] = Variant_Question::where('question_id', $question->id)->get();
			}
		}
		return view('test_questions', ['questions' => $questions, 'variants' => $variants, 'test' => $test, 'time' => $time]);
	}
}
