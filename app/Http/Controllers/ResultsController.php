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

class ResultsController extends Controller
{
	public function allow(FinishTest $request)
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
		$test = Test::findOrFail($test_s->test_id);
		$questions = Question::where('test_id', $test->id)->get();
		$points = 0;
		$points_total = 0;
		foreach ($questions as $question)
		{
			$points_total = $points_total + $question->points;
			if ($question->true_answer == $request->input('answers.'.$question->id))
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
			if ($question->true_answer == $answer)
			{
				Result_Question::create(['result_id' => $result->id, 'question_id' => $question->id, 'answer' => $answer, 'flag' => true]);
			}
			else Result_Question::create(['result_id' => $result->id, 'question_id' => $question->id, 'answer' => $answer, 'flag' => false]);
		}
			return view('result', ['points' => $points, 'points_total' => $points_total, 'test' => $test]);
	}
}
