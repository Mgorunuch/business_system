<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthFrizzed
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
        $user_status = Auth::user()->status;
        
        if($user_status == 2)
            return $next($request);
        if($user_status == 1)
            return redirect('/payments/pay/banned');

        return redirect('/blog');
    }
}
