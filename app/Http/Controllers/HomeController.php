<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if(role = dosen){
        //     return view ('dosen.home');    
        // }
        // else if (role = admin){
        //     return view ('admin.home');
        // }
        // else if (role = koor){
        //     return view ('koor.home');
        // }
        // else{
        //     return view ('mahasiswa.home');
        // }
        return view('home');
    }
}
