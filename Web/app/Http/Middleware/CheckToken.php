<?php

namespace App\Http\Middleware;

use Closure;
use App\Token;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->get('token');
        if (Token::where('token', '=', $token)->count() > 0)
            return $next($request);
        else
            return response('token mismatch!', '403');
    }
}
