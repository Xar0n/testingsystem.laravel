<?php

namespace App\Http\Middleware;

use App\Scheduled_Test;
use Closure;
use Illuminate\Support\Facades\Auth;

class AllowTest
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
    	//echo $request->route('test');
		echo $request->route('test_s');
		/*if (!$request->session()->has('test_s.id')) {
			if($request->has('test_s'))
			{
				$test_s_id = $request->input('test_s');
				$request->session()->push('test_s.id', $test_s_id);
			}
			else abort('404');
			$group_id = Auth::user()->group_id;
			$test_s = Scheduled_Test::where('id', $test_s_id)->get();

		}*/

        return $next($request);
    }
}
