<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    use HasFactory;

    // BreakTime.php
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
