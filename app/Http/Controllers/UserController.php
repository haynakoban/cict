<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function create()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $formFields = $request->validate([ 
            'employee_id' => ['required'],
            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required'],
            'username' => ['required', 'min:4', 'max:20', Rule::unique('admins', 'username')],
            'email' => ['required', 'email', Rule::unique('admins', 'email')],
            'password' => 'required|min:6',
            'position' => ['required'],
            'course_program' => ['required'],
            'dob' => ['required'],
            'age' => ['required'],
            'address' => ['required'],
        ]);

         // hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // create new user
        $user = User::create($formFields);

        if ($request->role == 'faculty') {
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => 2
            ]);
        } else {
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => 3
            ]);
        }

        return redirect('/')->with('message', 'User Created');
    }

    public function login()
    {
        return view('user.login');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('web')->attempt($formFields)) {
            $request->session()->regenerate();
            $user = User::where('id', auth('web')->user()->id)->first();
            $user->status = 1;
            $user->save();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['username' => 'Invalid credentials'])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        $user = User::where('id', auth('web')->user()->id)->first();
        $user->last_login = now();
        $user->status = 0;
        $user->save();

        auth('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'You have been logged out');
    }
}
