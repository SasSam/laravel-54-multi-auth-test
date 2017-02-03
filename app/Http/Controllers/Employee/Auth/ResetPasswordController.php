<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
     */

    use ResetsPasswords;

    protected $redirectTo = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('employee.dashboard');
        $this->middleware('guest.employee:employee');
    }

    protected function guard()
    {
        return Auth::guard('employee');
    }

    protected function broker()
    {
        return Password::broker('employees');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('employees.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

}
