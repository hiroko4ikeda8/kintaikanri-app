<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'attendance_date',
        'clock_in',
        'clock_out',
        'status',
        'total_work_time',
    ];

    // Attendance.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::saving(function ($attendance) {
            if ($attendance->clock_in && $attendance->clock_out) {
                // 勤務時間の差分（分）
                $workMinutes = Carbon::parse($attendance->clock_out)
                    ->diffInMinutes(Carbon::parse($attendance->clock_in));

                // 休憩時間の合計（分）
                $breakMinutes = $attendance->breakTimes->sum(function ($break) {
                    return Carbon::parse($break->break_end)
                        ->diffInMinutes(Carbon::parse($break->break_start));
                });

                // 勤務時間から休憩時間を差し引き、負数を避ける
                $attendance->total_work_time = max($workMinutes - $breakMinutes, 0);
            } else {
                $attendance->total_work_time = null; // 出勤・退勤未入力ならnull
            }
        });
    }

    public function breakTimes()
    {
        return $this->hasMany(BreakTime::class);
    }

    public function attendanceCorrectRequest()
    {
        return $this->hasOne(AttendanceCorrectRequest::class);
    }
}
