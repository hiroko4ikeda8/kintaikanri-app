<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        // ▼ 表示する日付（デフォルトは2025/05/01）
        $targetDate = $request->query('date', '2025-05-01');

        // ▼ Bladeへ渡すフォーマットに変換（例: 2025/05/01）
        $formattedDate = Carbon::parse($targetDate)->format('Y/m/d');

        // ▼ 勤怠データを取得（対象日は1日分のみ）＋ `admin` ユーザーを除外
        $attendances = Attendance::where('attendance_date', $targetDate)
            ->whereHas('user', function ($query) {
                $query->where('role', '!=', 'admin'); // ✅ `admin` ユーザーを除外
            })
            ->orderBy('clock_in') // 出勤時間順に並べる
            ->with(['breakTimes', 'user']) // ✅ ユーザー名を表示するため `user` をロード
            ->get();

        return view('admin.attendance.list.index', compact('attendances', 'targetDate', 'formattedDate'));
    }

    public function show($id)
    {
        $attendance = Attendance::with('user')->findOrFail($id);
        return view('admin.attendance.show', compact('attendance'));
    }
}
