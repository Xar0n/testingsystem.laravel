<?php

namespace App\Http\Controllers;

use App\Performed_Test;
use App\Result;
use App\Scheduled_Test;
use App\Test;
use Carbon\Carbon;
use App\Variant_Question;
use App\Question;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{
	protected function isHaveResult(Scheduled_Test $test_s)
	{
		try {
			$result = Result::where([['scheduled_test_id', $test_s->id], ['user_id', Auth::user()->id]])->get()[0];
			$result->flag = true;
			$result->test = Test::findOrFail($test_s->test_id);
			$questions = Question::where('test_id', $result->test->id)->get();
			$points_total = 0;
			foreach ($questions as $question)
			{
				$points_total = $points_total + $question->points;
			}
			$result->points_total = $points_total;
			return $result;
		} catch (\Exception $exception) {
			$result = new \stdClass();
			$result->flag = false;
			return $result;
		}
	}
	protected function allow(Scheduled_Test $test_s)
	{
		try {
			$p_test = Performed_Test::where([['scheduled_test_id', $test_s->id], ['user_id', Auth::user()->id]])->get()[0];
		} catch (\Exception $exception) {
			$p_test = new Performed_Test;
			$p_test->scheduled_test_id = $test_s->id;
			$p_test->user_id = Auth::user()->id;
			$p_test->date_time = Carbon::now();
			$p_test->save();
			$parts = explode(':', $test_s->time);
			$time = new \stdClass();
			$time->h = (int)$parts[0];
			$time->i = (int)$parts[1];
			$time->s = (int)$parts[2];
			return $time;
		}
		$dt = new \DateTime($p_test->date_time); //Как же не хочу на Carboon переправлять
		$parts = explode(':', $test_s->time);
		$interval = new \DateInterval('PT' . (int)$parts[0] . 'H' . $parts[1] . 'M' . $parts[2] . 'S');
		$dt->add($interval);
		$date = $dt->format('Y-m-d H:i:s');
		if (date($date) < Carbon::now())
		{
			echo 'Время истекло';
			abort(404);
		} else {
			$diff = Carbon::createFromTimeString($date)->diff(Carbon::now());
			return $diff;
		}
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
		$result = $this->isHaveResult($test_s);
		if($result->flag)
		{
			return view('result', ['points' => $result->points, 'points_total' => $result->points_total, 'test' => $result->test]);
		}
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
