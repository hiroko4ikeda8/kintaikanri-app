<?php

namespace App\Http\Controllers\User;

use App\Models\AttendanceCorrectRequest;
use App\Models\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserStampCorrectionRequestController extends Controller
{
    public function index()
    {
        $requests = AttendanceCorrectRequest::where('user_id', auth()->id())->with('attendance')->get(); // 申請データを取得
        return view('user.stamp_correction_request.index', compact('requests'));
    }
}
