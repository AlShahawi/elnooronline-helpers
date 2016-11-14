<?php

namespace App\Http\Middleware;

use Closure;

class Unauthorized
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
        if ($request->ajax() || $request->wantsJson()) {
                return response('<p style="color:red">'.trans('lang.unauthorized').'</style>', 400);
            }
        return view('helpers.unauthorized');
        // return $next($request);
    }
}
