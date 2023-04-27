<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $faculties = DB::table('users')
                    ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
                    ->where('user_roles.role_id', 2)
                    ->paginate(10);

        $attendanceCheckers = DB::table('users')
                    ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
                    ->where('user_roles.role_id', 3)
                    ->paginate(10);

        return view('admin.index', compact('faculties', 'attendanceCheckers'));
    }

    public function create()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $formFields = $request->validate([
            'fullname' => ['required'],
            'username' => ['required', 'min:4', 'max:20', Rule::unique('admins', 'username')],
            'email' => ['required', 'email', Rule::unique('admins', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

         // hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // create new admin
        $admin = Admin::create($formFields);      

        // login
        Auth::guard('admin')->login($admin);

        return redirect('/')->with('message', 'User Created and Logged in');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['username' => 'Invalid credentials'])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        auth('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('message', 'You have been logged out');
    }

    public function attendances()
    {
        $attendances = DB::table('attendances')
            ->join('rooms', 'rooms.id', '=', 'attendances.room_id')
            ->join('users', 'users.id',  '=', 'attendances.user_id')
            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->select('attendances.status as attendance_status', 'attendances.id as attendance_id', 'attendances.*' , 'rooms.*', 'users.*', 'user_roles.*')
            ->where('user_roles.role_id', 2) // change the role id here
            ->orderBy('attendances.created_at', 'desc')
            ->paginate(10);

        return view('admin.attendances', compact('attendances'));
    }

    public function attendance($id)
    {
        $attendance = DB::table('attendances')
            ->join('rooms', 'rooms.id', '=', 'attendances.room_id')
            ->join('users', 'users.id',  '=', 'attendances.user_id')
            ->select('attendances.status as attendance_status', 'attendances.id as attendance_id', 'attendances.*' , 'rooms.name', 'users.first_name', 'users.last_name')
            ->where('attendances.id', $id)
            ->first();

        return view('admin.attendance', compact('attendance'));
    }

    public function history()
    {
        $histories = DB::table('keys')
            ->join('rooms', 'rooms.id', '=', 'keys.room_id')
            ->join('users', 'users.id',  '=', 'keys.user_id')
            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->select('keys.id as key_id', 'keys.status as key_status', 'keys.*' , 'rooms.name', 'users.first_name', 'users.last_name', 'user_roles.*')
            ->where('user_roles.role_id', 2)
            ->paginate(10);

        return view('admin.history', compact('histories'));
    }

    public function keys()
    {
        $rooms = Room::paginate(10);

        return view('admin.keys', compact('rooms'));
    }
}
