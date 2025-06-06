<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttendanceCorrectRequest;
use Illuminate\Http\Request;

class StampCorrectionRequestController extends Controller
{
    public function index()
    {
        $requests = AttendanceCorrectRequest::whereHas('user', function ($query) {
            $query->where('role', 'user'); // ✅ 一般ユーザーのデータのみ取得
        })->get();

        return view('admin.stamp_correction_request.index', compact('requests'));
    }
    
    public function approve(AttendanceCorrectRequest $attendance_correct_request)
    {
        $attendance_correct_request->load('correctBreaks');
        return view('admin.stamp_correction_request.approve', compact('attendance_correct_request'));
    }
}
