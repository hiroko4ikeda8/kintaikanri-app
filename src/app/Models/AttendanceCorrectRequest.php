<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceCorrectRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'attendance_id',
        'correct_clock_in',
        'correct_clock_out',
        'remarks',
        'status',
    ];

    // 定数として持たせておく
    public const STATUS_JP = [
        'pending' => '承認待ち',
        'approved' => '承認済み',
        'rejected' => '却下',
    ];

    public function getStatusJpAttribute()
    {
        return self::STATUS_JP[$this->status] ?? '不明なステータス';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function correctBreaks()
    {
        return $this->hasMany(AttendanceCorrectBreak::class);
    }
}
