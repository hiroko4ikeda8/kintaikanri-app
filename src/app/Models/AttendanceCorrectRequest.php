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

    // ✅ 日本語表記のアクセサを追加
    public function getStatusJpAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return '承認待ち';
            case 'approved':
                return '承認済み';
            case 'rejected':
                return '却下';
            default:
                return '不明なステータス';
        }
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
