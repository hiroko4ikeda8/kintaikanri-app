<?php

namespace App\Http\Controllers\User;

use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\AttendanceCorrectRequest;
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
        $targetMonth = $request->query('month', '2025-05');
        $formattedMonth = Carbon::parse($targetMonth . '-01')->format('Y/m');

        $startOfMonth = Carbon::parse($targetMonth . '-01');
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        // 対象月のすべての日をコレクション化
        $allDates = collect();
        $date = $startOfMonth->copy();
        while ($date->lte($endOfMonth)) {
            $allDates->push($date->copy());
            $date->addDay();
        }

        // 既存の勤怠データを取得（with付き）
        $attendances = Attendance::where('user_id', $userId)
            ->whereBetween('attendance_date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->orderBy('attendance_date')
            ->with(['breakTimes', 'attendanceCorrectRequest']) // ← ここを追加
            ->get()
            ->keyBy('attendance_date'); // 日付をキーに

        $attendanceList = $allDates->map(function ($date, $index) use ($attendances, $userId) {
            $dateStr = $date->toDateString();
            if ($attendances->has($dateStr)) {
                return $attendances->get($dateStr); // 実データ
            }

            // 欠勤：仮のIDを付与（例えば "absent_2025-05-01" など）
            $fake = new Attendance([
                'user_id' => $userId,
                'attendance_date' => $dateStr,
                'status' => '欠勤',
                'clock_in' => null,
                'clock_out' => null,
                'total_work_time' => 0,
            ]);
            $fake->id = 'absent_' . $dateStr; // ← 仮のID文字列
            return $fake;
        });

        if ($request->ajax()) {
            return response()->json([
                'month' => $formattedMonth,
                'attendances' => $attendances,
            ]);
        }

        return view('user.attendance.list.index', [
            'attendances' => $attendanceList, // ← こちらに変更
            'targetMonth' => $targetMonth,
            'formattedMonth' => $formattedMonth,
        ]);
    }

    public function show(Request $request, $id)
    {
        // $idが 'absent_' で始まる場合は欠勤仮オブジェクトを作成して返す
        if (str_starts_with($id, 'absent_')) {
            $dateStr = str_replace('absent_', '', $id);

            $attendance = new Attendance([
                'user_id' => Auth::id(),
                'attendance_date' => $dateStr,
                'status' => '欠勤',
                'clock_in' => null,
                'clock_out' => null,
                'total_work_time' => 0,
            ]);

            // 空の休憩コレクションをセット
            $attendance->setRelation('breakTimes', new Collection());

            $message = 'この日は出勤記録がなく、欠勤とみなされます。';
            return view('user.attendance.show', compact('attendance', 'message'));
        }

        // それ以外は通常の勤怠詳細表示
        $attendance = Attendance::with('breakTimes')->findOrFail($id);

        if ($request->from === 'request') {
            $message = '申請一覧画面から遷移しました。';
        } else {
            $message = '通常の勤怠詳細ページです。';
        }

        return view('user.attendance.show', compact('attendance', 'message'));
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


    // 勤怠修正申請一覧（元index）
    public function correctionRequestList()
    {
        $pendingRequests = AttendanceCorrectRequest::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->with(['user', 'attendance'])
            ->get();

        $approvedRequests = AttendanceCorrectRequest::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->with(['user', 'attendance'])
            ->get();

        return view('user.stamp_correction_request.index', compact('pendingRequests', 'approvedRequests'));
    }


}
