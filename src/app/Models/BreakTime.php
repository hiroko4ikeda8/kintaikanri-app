<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    use HasFactory;

    // BreakTime モデル
    protected $fillable = [
        'break_start',
        'break_end',
        'attendance_id',
    ];

    // BreakTime.php
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
