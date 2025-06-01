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

    public function index(Request $request)
    {
        $userId = Auth::id();

        // ▼ 初期値を「2025-05」に変更
        $targetMonth = $request->query('month', '2025-05');

        $formattedMonth = Carbon::parse($targetMonth . '-01')->format('Y/m');

        $attendances = Attendance::where('user_id', $userId)
            ->where('attendance_date', 'like', $targetMonth . '%')
            ->orderBy('attendance_date')
            ->with('breakTimes')
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'month' => $formattedMonth,
                'attendances' => $attendances,
            ]);
        }

        return view('user.attendance.list.index', compact('attendances', 'targetMonth', 'formattedMonth'));
    }


    public function show($id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('user.attendance.show', compact('attendance'));
    }
}
