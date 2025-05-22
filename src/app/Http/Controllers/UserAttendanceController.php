<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class UserAttendanceController extends Controller
{
    public function create()
    {
        return view('attendance.create');
    }

    public function index()
    {
        return view('attendance.list.index');
    }

    public function show($id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('attendance.show', compact('attendance'));
    }
}
