<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:dosen')->except('logout');
        $this->middleware('guest:koor')->except('logout');
        $this->middleware('guest:web')->except('logout');

        // $this->middleware('guest:mahasiswa')->except('logout');

    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => route('admin.login-view'), 'title'=>'Admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required|username',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt($request->only(['username','password']), $request->get('remember'))){
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withInput($request->only('username', 'remember'));
    }

    public function showDosenLoginForm()
    {
        return view('auth.login', ['url' => route('dosen.login-view'), 'title'=>'dosen']);
    }

    public function dosenLogin(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required|username',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('dosen')->attempt($request->only(['username','password']), $request->get('remember'))){
            return redirect()->intended('/dosen/dashboard');
        }

        return back()->withInput($request->only('username', 'remember'));
    }

    public function showKoorLoginForm()
    {
        return view('auth.login', ['url' => route('koor.login-view'), 'title'=>'koor']);
    }

    public function koorLogin(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required|username',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('koor')->attempt($request->only(['username','password']), $request->get('remember'))){
            return redirect()->intended('/koor/dashboard');
        }

        return back()->withInput($request->only('username', 'remember'));
    }
}
