<?php

namespace App\Http\Middleware;

use App\Scheduled_Test;
use Carbon\Carbon;
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
		if ($request->session()->has('test_s.id')) {
			$request->session()->forget('test_s.id');
		}
		$test_s_id = $request->route('test_s');
		$test_s = Scheduled_Test::findOrFail($test_s_id);
		$group_id = Auth::user()->group_id;
		if($group_id == $test_s->group_id) {
			if($test_s->date_first > Carbon::now()) {
				abort(404);
			} elseif($test_s->date_last < Carbon::now()) {
				abort(404);
			}
			$request->session()->push('test_s.id', $test_s->id);
		}
		else abort(404);
        return $next($request);
    }
}
