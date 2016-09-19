<?php namespace App\Http\Middleware;

use Closure;
use Input;
use Redirect;

class Login{

	public function handle($request, Closure $next)
	{
        if ($request->input('i_usuario') =='admin@wanai.com'){
            return Redirect::to('registro');
        }
        else{
        	return Redirect::to('login');
        }

        return $next($request);
    }
}
