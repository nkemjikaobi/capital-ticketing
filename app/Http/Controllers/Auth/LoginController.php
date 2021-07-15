<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo() {

        $account_type = Auth::user()->account_type; 
        switch ($account_type) {
            case 1:
                return '/home';
                break;

            case 2:
                return '/home';
                break; 

            case 3:
                return '/admin/index';
                break;

            default:
                return '/home'; 
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

      /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // protected function sendFailedLoginResponse(Request $request)
    // {
    //     $errors = [$this->username() => trans('auth.failed')];
    
    //     // Load user from database
    //     $user = User::where($this->username(), $request->{$this->username()})->first();
    
    //     if ($user && !Hash::check($request->password, $user->password)) {
    //         $errors = ['password' => 'Wrong password'];
    //     }
    
    //     if ($request->expectsJson()) {
    //         return response()->json($errors, 422);
    //     }
    
    //     return redirect()->back()
    //         ->withInput($request->only($this->username(), 'remember'))
    //         ->withErrors($errors);
    // }
}
