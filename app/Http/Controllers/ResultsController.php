<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinishTest;
use App\Scheduled_Test;
use App\Question;
use App\Result;
use App\Result_Question;
use App\Test;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Performed_Test;

class ResultsController extends Controller
{
	protected function isNotOverTime(Scheduled_Test $test_s)
	{
		$p_test = Performed_Test::where([['scheduled_test_id', $test_s->id], ['user_id', Auth::user()->id]])->get()[0];
		$dt = new \DateTime($p_test->date_time);
		$parts = explode(':', $test_s->time);
		$parts[1] = (int)$parts[1] + 1;
		$interval = new \DateInterval('PT' . (int)$parts[0] . 'H' . $parts[1] . 'M' . $parts[2] . 'S');
		$dt->add($interval);
		$date = $dt->format('Y-m-d H:i:s');
		if (date($date) < Carbon::now())
		{
			echo 'Время истекло';
			abort(404);
		}
	}

	protected function allow(FinishTest $request)
	{
		if($request->session()->has('test_s.id'))
		{
			$test_s_id = $request->session()->get('test_s.id')[0];
			$request->session()->forget('test_s.id');
			return $test_s_id;
		}
		else {
			abort(404);
		}

	}
    public function index(FinishTest $request)
	{
		$test_s_id = $this->allow($request);
		$test_s = Scheduled_Test::findOrFail($test_s_id);
		$result_old = $this->isHaveResult($test_s);
		if($result_old->flag)
		{
			return view('result', ['points' => $result->points, 'points_total' => $result->points_total, 'test' => $result->test]);
		}
		$this->isNotOverTime($test_s);
		$test = Test::findOrFail($test_s->test_id);
		$questions = Question::where('test_id', $test->id)->get();
		$points = 0;
		$points_total = 0;
		foreach ($questions as $question)
		{
			$points_total = $points_total + $question->points;
			echo 'Вопрос:'.$question->true_answer.'. Ответ:'.$request->input('answers.'.$question->id).PHP_EOL;
			if (mb_strtolower($question->true_answer) == mb_strtolower($request->input('answers.'.$question->id)))
			{
				$points = $points + $question->points;
			}
		}
		$result = new Result;
		$result->scheduled_test_id = $test_s->id;
		$result->user_id = Auth::user()->id;
		$result->points = $points;
		$result->date = Carbon::now();
		$result->save();
		foreach ($questions as $question)
		{
			$answer = is_null($request->input('answers.'.$question->id)) ? '' : $request->input('answers.'.$question->id);
			if (mb_strtolower($question->true_answer) == mb_strtolower($answer))
			{
				Result_Question::create(['result_id' => $result->id, 'question_id' => $question->id, 'answer' => $answer, 'flag' => true]);
			}
			else Result_Question::create(['result_id' => $result->id, 'question_id' => $question->id, 'answer' => $answer, 'flag' => false]);
		}
			return view('result', ['points' => $points, 'points_total' => $points_total, 'test' => $test]);
	}
}
