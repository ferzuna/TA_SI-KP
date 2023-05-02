<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Welcome
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $i = Auth::user();
        if (!isset($i)) {
            return $next($request);
        }else if(Auth::user()->role_id == 1){
            return redirect('/mahasiswa');
        }else if(Auth::user()->role_id == 2){
            return redirect('/koordinator');
        }else if(Auth::user()->role_id == 3){
            return redirect('/admin');
        }else if(Auth::user()->role_id == 4){
            return redirect('/dosen');
        }else{
            return $next($request);
        }
        
    }
}
