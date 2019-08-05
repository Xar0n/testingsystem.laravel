<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class RedirectIsAdmin
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
    	if($request->isMethod('post') and $request->has('name') and $request->has('password'))
		{
			$name = $request->input('name');
			$password = $request->input('password');
			if(('Lalka228' === $name) and ('123456' === $password))
			{
				$request->session()->push('admin.name', $name);
				$request->session()->push('admin.password', $password);
				return redirect('/admin_panel');
			}
		}
        return $next($request);
    }
}
