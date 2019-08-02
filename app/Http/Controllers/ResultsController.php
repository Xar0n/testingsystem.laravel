<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinishTest;
use Illuminate\Http\Request;
use App\Question;
use App\Result;
use App\Result_Question;
use App\Test;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ResultsController extends Controller
{
    public function index(FinishTest $request)
	{
		if ($request->isMethod('post') and !is_null(session('test.id'))) {
			$test_id = session('test.id')[0];
			$user_id = Auth::user()->id;
			Session::forget('test.id');
			$questions = Question::where('test', '=', $test_id)->get();
			$test = Test::findOrFail($test_id);
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
			Result::create(['test' => $test_id, 'user' => $user_id, 'result' => $points, 'date' => Carbon::now()]);
			$result = Result::orderBy('id', 'desc')->first();
			foreach ($questions as $question)
			{
				$answer = is_null($request->input('answers.'.$question->id)) ? '' : $request->input('answers.'.$question->id);
				if ($question->true_answer == $answer)
				{
					Result_Question::create(['result' => $result->id, 'question' => $question->id, 'answer' => $answer, 'flag' => true]);
				}
				else Result_Question::create(['result' => $result->id, 'question' => $question->id, 'answer' => $answer, 'flag' => false]);
			}
			return view('result', ['points' => $points, 'points_total' => $points_total, 'test' => $test]);
		}
		else abort(507);
	}
}
