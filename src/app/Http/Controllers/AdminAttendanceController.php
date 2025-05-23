<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AdminAttendanceController extends Controller
{
    public function index()
    {
        return view('admin.attendance.list.index');
    }

    public function show($id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('admin.attendance.show', compact('attendance'));
    }
}
