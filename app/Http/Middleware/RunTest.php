<?php

namespace App\Http\Middleware;

use App\Performed_Test;
use App\Scheduled_Test;
use Carbon\Carbon;
use Closure;
class RunTest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
	{
		if ($request->session()->has('test.id')) {
			$test_id = $request->session()->get('test.id')[0];
			$user_id = Auth::user()->id;
			//$s_test = Scheduled_Test::where('');
			$p_test = Performed_Test::where('user_id', $user_id, 'test_id', $test_id)->get();
			if(isset($p_test)) {
				$p_test = new Performed_Test();
				$p_test->user_id = $user_id;
				$p_test->test_id = $test_id;
				$p_test->date_time = Carbon::now();
				$p_test->save();
			}
			else
			{
				//if
			}
		} else {
			throw new \HttpException(404);
		}
        return $next($request);
    }
}
