<?php

namespace App\Http\Controllers\User;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAttendanceController extends Controller
{
    public function create()
    {
        return view('user.attendance.create');
    }

    public function index()
    {
        return view('user.attendance.list.index');
    }

    public function show($id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('user.attendance.show', compact('attendance'));
    }
}
