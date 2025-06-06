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
        $attendance = Attendance::with('user')->findOrFail($id);
        return view('user.attendance.show', compact('attendance'));
    }

    public function edit($attendanceId)
    {
        $attendance = Attendance::with('breakTimes')->findOrFail($attendanceId);
        return view('attendance.edit', compact('attendance'));
    }

    public function update(Request $request, $attendanceId)
    {
        $attendance = Attendance::findOrFail($attendanceId);

        // 休憩時間は配列で送られてくる想定
        $breakStarts = $request->input('break_start', []);
        $breakEnds = $request->input('break_end', []);

        // 既存のbreakTimesを削除して更新する例（処理は要検討）
        $attendance->breakTimes()->delete();

        foreach ($breakStarts as $index => $start) {
            $end = $breakEnds[$index] ?? null;
            if ($start && $end) {
                $attendance->breakTimes()->create([
                    'break_start' => $start,
                    'break_end' => $end,
                ]);
            }
        }

        // 他の勤怠データ更新処理もここに書く

        $attendance->save();

        return redirect()->route('attendance.edit', $attendanceId)->with('success', '更新しました');
    }
}
