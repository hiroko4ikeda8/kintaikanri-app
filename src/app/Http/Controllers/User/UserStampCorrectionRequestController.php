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
        $requests = AttendanceCorrectRequest::whereHas('user', function ($query) {
            $query->where('role', 'user'); // ✅ 一般ユーザーのデータのみ取得
        })->get();

        return view('user.stamp_correction_request.index', compact('requests'));
    }
}