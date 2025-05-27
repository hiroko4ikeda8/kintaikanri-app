<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    public function index()
    {
        return view('admin.staff.index');
    }

    public function showAttendances($id)
    {
        $attendances = Attendance::where('user_id', $id)->get();
        return view('admin.attendance.staff.show', compact('attendances'));
    }
}
