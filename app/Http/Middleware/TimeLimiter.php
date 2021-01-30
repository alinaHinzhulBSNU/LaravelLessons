<?php

namespace App\Http\Middleware;

use Closure;

class TimeLimiter
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
        //Правильний час
        date_default_timezone_set("Europe/Kiev");
        
        if(date('H') == 13){
            return response('Обідня перерваю. Заходьте пізніше.');
        }
        
        return $next($request);
    }
}
