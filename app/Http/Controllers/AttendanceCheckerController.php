<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\AttendanceChecker;
use Illuminate\Support\Facades\DB;

class AttendanceCheckerController extends Controller
{
    public function index()
    {
        $attendances = DB::table('attendances')
            ->join('rooms', 'rooms.id', '=', 'attendances.room_id')
            ->join('users', 'users.id',  '=', 'attendances.user_id')
            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->select('attendances.status as attendance_status', 'attendances.id as attendance_id', 'attendances.*' , 'rooms.*', 'users.*', 'user_roles.*')
            ->where('user_roles.role_id', 3) // select the attendance checker
            ->orderBy('attendances.created_at', 'desc')
            ->paginate(10);

        return view('checker.index', compact('attendances'));
    }

    public function show($id)
    {
        $attendance = DB::table('attendances')
            ->join('rooms', 'rooms.id', '=', 'attendances.room_id')
            ->join('users', 'users.id',  '=', 'attendances.user_id')
            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->select('attendances.status as attendance_status', 'attendances.id as attendance_id', 'attendances.*' , 'rooms.name', 'users.first_name', 'users.last_name')
            ->where('attendances.id', $id)
            ->first();

        return view('checker.show', compact('attendance'));
    }

    
    public function update(Request $request, $id)
    {
        $attendance = Attendance::where('id', $id)->first();

        if($request->status){
            $attendance->status = $request->status;
        }

        if($request->comments){
            $attendance->comments = $request->comments;
        }

        $attendance->save();

        return redirect('/checker/attendances');
    }
}
