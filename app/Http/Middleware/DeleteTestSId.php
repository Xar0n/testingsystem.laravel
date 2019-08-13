<?php

namespace App\Http\Middleware;

use Closure;

class DeleteTestSId
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
    	if($request->session()->has('test_s.id'))
		{
			$request->session()->forget('test_s.id');
		}
        return $next($request);
    }
}
