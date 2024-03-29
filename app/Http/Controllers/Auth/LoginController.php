<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

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
        // $this->middleware('guest:admin')->except('logout');
        // $this->middleware('guest:dosen')->except('logout');
        // $this->middleware('guest:koor')->except('logout');
        // $this->middleware('guest:web')->except('logout');

        // $this->middleware('guest:mahasiswa')->except('logout');

    }
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }
    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    protected function authenticated(Request $request, $user){
        if ($user->hasRole('admin')){
            return redirect()->route('admin');
        }
        else if ($user->hasRole('dosen')){
            return redirect()->route('dosen');
        }
        else if ($user->hasRole('koor')){
            return redirect()->route('koordinator');
        }
        else if ($user->hasRole('mahasiswa')){
            return redirect()->route('mahasiswa');
        }

        return redirect()->route('welcome');
    }

    // public function showAdminLoginForm()
    // {
    //     return view('auth.login', ['url' => route('admin.login-view'), 'title'=>'Admin']);
    // }

    // public function adminLogin(Request $request)
    // {
    //     $this->validate($request, [
    //         'email'   => 'required|email',
    //         'password' => 'required|min:6'
    //     ]);

    //     if (Auth::guard('admin')->attempt($request->only(['email','password']), $request->get('remember'))){
    //         return redirect()->intended('/admin/dashboard');
    //     }

    //     return back()->withInput($request->only('email', 'remember'));
    // }
}
