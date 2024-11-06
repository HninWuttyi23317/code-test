<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registration(){
        return view('auth.registration');
    }
    public function login(){
        return view('auth.login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate
        ([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();
            if($user->role == 'user'){
                $employees = Employee::paginate(4);
                return view('employees.index',compact('employees'));
            }
            else if($user->role == 'admin'){
                $companies = Company::paginate(4);
                return view('companies.index',compact('companies'));
            }
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
