<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Cekrole
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
        // $user = \App\User::where('email', $request->email)->first();
        // if ($user->status == 'admin') {
        //     return redirect('admin/dashboard');
        // } elseif ($user->status == 'mahasiswa') {
        //     return redirect('mahasiswa/dashboard');
        // }
        
        // return $next($request);
    }
}
