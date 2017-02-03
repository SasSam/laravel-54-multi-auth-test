<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth.employee:employee');
    }

    public function index(Request $request)
    {
        $users[] = Auth::user();
        $users[] = Auth::guard()->user();
        $users[] = Auth::guard('employee')->user();

        dd($users);

        return view('employees.home.index');
    }
}
