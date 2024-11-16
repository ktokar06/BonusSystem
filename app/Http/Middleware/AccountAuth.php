<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
	
		if (!session()->has('accountId')){
			return redirect()->route('LoginPage')
				->with('error', 'Сначала войдите в свой аккаунт');	
		}	

		return $next($request);
    }
}
