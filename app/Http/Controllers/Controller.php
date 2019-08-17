<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Scheduled_Test;
use App\Test;
use App\Question;
use App\Result;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
			$result->flag = true;
			return $result;
		} catch (\Exception $exception) {
			$result = new \stdClass();
			$result->flag = false;
			return $result;
		}
	}
}
