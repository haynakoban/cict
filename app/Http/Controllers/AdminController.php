<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Key;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $keyword = request('keyword');

        $faculties = DB::table('users')
                    ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
                    ->where('user_roles.role_id', 2)
                    ->when($keyword, function ($query, $keyword) {
                        return $query->where('users.first_name', 'like', '%' . $keyword . '%')
                            ->orWhere('users.last_name', 'like', '%' . $keyword . '%')
                            ->orWhere('users.username', 'like', '%' . $keyword . '%')
                            ->orWhere('users.email', 'like', '%' . $keyword . '%')
                            ->orWhere('users.status', 'like', '%' . $keyword . '%');
                    })->get();

        $attendanceCheckers = DB::table('users')
                    ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
                    ->where('user_roles.role_id', 3)
                    ->when($keyword, function ($query, $keyword) {
                        return $query->where('users.first_name', 'like', '%' . $keyword . '%')
                            ->orWhere('users.last_name', 'like', '%' . $keyword . '%')
                            ->orWhere('users.username', 'like', '%' . $keyword . '%')
                            ->orWhere('users.email', 'like', '%' . $keyword . '%')
                            ->orWhere('users.status', 'like', '%' . $keyword . '%');
                    })->get();

        // return view('admin.index', compact('faculties', 'attendanceCheckers', 'keyword'));
        return [
            'faculties' => $faculties,
            'attendanceCheckers' => $attendanceCheckers,
            'keyword' => $keyword
        ];
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

    public function history()
    {
        $histories = DB::table('keys')
            ->join('rooms', 'rooms.id', '=', 'keys.room_id')
            ->join('users', 'users.id',  '=', 'keys.user_id')
            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->select('keys.id as key_id', 'keys.status as key_status', 'keys.*' , 'rooms.name', 'users.first_name', 'users.last_name', 'user_roles.*')
            ->where('user_roles.role_id', 2)
            ->get();

        // return view('admin.history', compact('histories'));
        return $histories;
    }

    public function keys()
    {
        $keyword = request('keyword');
        $rooms = DB::table('rooms')
                    ->when($keyword, function ($query, $keyword) {
                        return $query->where('rooms.name', 'like', '%' . $keyword . '%')
                            ->orWhere('rooms.status', 'like', '%' . $keyword . '%');
                    })->get();
                    
        $rooms_keys = DB::table('rooms')
                    ->where('status', 'borrowed')
                    ->get()
                    ->pluck('id')
                    ->toArray();

        $keys_id = DB::table('keys')
                ->whereIn('room_id', $rooms_keys)
                ->select(DB::raw('MAX(id) AS id'))
                ->groupBy('room_id')
                ->get()
                ->pluck('id')
                ->toArray();

        $keys = DB::table('keys')
                ->join('users', 'users.id', '=', 'keys.user_id')
                ->whereIn('keys.id', $keys_id)
                ->get();

        $users = DB::table('users')
                    ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
                    ->select('users.id as user_id', 'users.first_name', 'users.last_name', 'user_roles.*')
                    ->where('user_roles.role_id', 2) // select faculty only
                    ->get();


        // return view('admin.keys', compact('rooms', 'keyword'));
        return [
            'rooms' => $rooms,
            'keyword' => $keyword,
            'users' => $users,
            'keys' => $keys,
        ];
    }

    public function key($id)
    {
        $room = Room::where('id', $id)->first();

        $users = DB::table('users')
                    ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
                    ->select('users.id as user_id', 'users.first_name', 'users.last_name', 'user_roles.*')
                    ->where('user_roles.role_id', 2) // select faculty only
                    ->get();

        // return view('admin.key', compact('room', 'users'));
        return [
            'rooms' => $room,
            'users' => $users
        ];
    }

    public function createKey(Request $request)
    {
        $room = Room::where('id', $request->room_id)->first();

        $room->status = $request->room_status == 'available' ? 'borrowed' : 'available';
        $room->save();

        Key::create([
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'time' => now(),
            'status' => $request->room_status == 'available' ? 'Borrowed' : 'Returned',
        ]);

        return response()->json(['message' => 'new key created']);  

    }

    public function indexSchedule()
    {
        $semesters = array(
            '2018-2019 1st Semester', '2018-2019 2nd Semester',
            '2019-2020 1st Semester', '2019-2020 2nd Semester',
            '2020-2021 1st Semester', '2020-2021 2nd Semester',
            '2021-2022 1st Semester', '2021-2022 2nd Semester',
            '2022-2023 1st Semester', '2022-2023 2nd Semester',
            '2023-2024 1st Semester', '2023-2024 2nd Semester',
            '2024-2025 1st Semester', '2024-2025 2nd Semester',
            '2025-2026 1st Semester', '2025-2026 2nd Semester',
        );

        $users = DB::table('users')
                ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
                ->where('user_roles.role_id', 2) // change the role id here
                ->get();

        $rooms = DB::table('rooms')->get();

        $schedules = DB::table('schedules')
            ->join('rooms', 'rooms.id', '=', 'schedules.room_id')
            ->join('users', 'users.id',  '=', 'schedules.user_id')
            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->select('schedules.status as schedule_status', 'schedules.id as schedule_id', 'schedules.*' , 'rooms.status as room_status', 'rooms.*', 'users.*', 'user_roles.*')
            ->where('user_roles.role_id', 2) // change the role id here
            ->orderBy('schedules.created_at', 'desc')
            ->get();

        // return view('admin.schedules', compact('schedules', 'keyword', 'semester_keyword'));
        return [
            'schedules' =>  $schedules,
            'semesters' => $semesters,
            'users' => $users,
            'rooms' => $rooms,
        ];
    }

    public function showSchedule($id)
    {
        $schedule = DB::table('schedules')
            ->join('rooms', 'rooms.id', '=', 'schedules.room_id')
            ->join('users', 'users.id',  '=', 'schedules.user_id')
            ->select('schedules.status as schedule_status', 'schedules.id as schedule_id', 'schedules.*' , 'rooms.name', 'users.first_name', 'users.last_name')
            ->where('schedules.id', $id)
            ->first();

        return view('admin.showSchedule', compact('schedule'));
    }

    public function createSchedule()
    {
        $rooms = Room::all();
        $users = DB::table('users')
                    ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
                    ->select('users.id as user_id', 'users.first_name', 'users.last_name', 'user_roles.*')
                    ->where('user_roles.role_id', 2) // select faculty only
                    ->get();

        return view('admin.createSchedule', compact('rooms', 'users'));
    }

    public function storeSchedule(Request $request)
    {
        $formFields = $request->validate([
            'subject_name' => ['required'],
            'section_name' => ['required'],
            'user_id' => ['required'],
            'room_id' => ['required'],
            'group' => ['required'],
            'day' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'semester' => ['required'],
        ]);

        Schedule::create($formFields);  

        return response()->json(['message' => 'success']);
    }
}
