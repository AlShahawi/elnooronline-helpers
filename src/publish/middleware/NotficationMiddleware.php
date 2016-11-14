<?php

namespace App\Http\Middleware;

use Closure;

class NotficationMiddleware
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
        foreach (\App\Notfication::all() as $notfication) 
        {
            $model = '\App\\'.ucfirst(str_singular(camel_case($notfication->notifiable_type)));
            $id = $notfication->notifiable_id ;
            if (is_null($model::find($id))) 
            {
                $notfication->delete();
            }
        }
        return $next($request);
    }
}
