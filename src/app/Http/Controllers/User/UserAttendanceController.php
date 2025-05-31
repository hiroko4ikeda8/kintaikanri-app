<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAttendanceController extends Controller
{
    public function create()
    {
        $status = '勤務外';
        $attendance_date = '2023年6月1日(木)';
        $clock_in = '08:00';

        return view('user.attendance.create', compact('status', 'attendance_date', 'clock_in'));
    }

    public function index()
    {
        $userId = Auth::id(); // 現在ログイン中のユーザーID
        $targetMonth = '2025-04';

        // 年/月形式に変換
        $formattedMonth = Carbon::parse($targetMonth . '-01')->format('Y/m');

        $attendances = Attendance::where('user_id', $userId)
            ->where('attendance_date', 'like', $targetMonth . '%')
            ->orderBy('attendance_date')
            ->get();

        return view('user.attendance.list.index', compact('attendances', 'targetMonth', 'formattedMonth'));
    }

    public function show($id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('user.attendance.show', compact('attendance'));
    }
}
