<?php

namespace App\Http\Middleware;

use Closure;

class ResponseHeader
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
        return $next($request);
        
        //キャッシュコントロール対策
        $responce->header('Cache-Control', 'no-cache,private');
         
        //クリックジャッキング対策
        $responce->header('X-Frame-Options', 'DENY');
         
        //意図しないXSS（文字コード）対策
        $responce->header('Content-Type', 'charset=UTF-8');
        return $responce;
    }
}
