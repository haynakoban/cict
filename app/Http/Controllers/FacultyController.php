<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacultyController extends Controller
{
    //
    public function index(){
        $id = 16;

        $attendances = DB::table('attendances')
            ->join('rooms', 'rooms.id', '=', 'attendances.room_id')
            ->join('users', 'users.id',  '=', 'attendances.user_id')
            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->select('attendances.status as attendance_status', 'attendances.id as attendance_id', 'attendances.*' , 'rooms.*', 'users.*', 'user_roles.*')
            ->where('attendances.user_id', $id)
            ->orderBy('attendances.created_at', 'desc')
            ->paginate(10);

        return view('faculty.index', compact('attendances'));
    }

    public function show($id)
    {
        //
        $attendance = DB::table('attendances')
            ->join('rooms', 'rooms.id', '=', 'attendances.room_id')
            ->join('users', 'users.id',  '=', 'attendances.user_id')
            ->select('attendances.status as attendance_status', 'attendances.id as attendance_id', 'attendances.*' , 'rooms.name', 'users.first_name', 'users.last_name')
            ->where('attendances.id', $id)
            ->first();

        return view('faculty.faculty', compact('attendance'));
    }
}
