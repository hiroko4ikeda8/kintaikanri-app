<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceCorrectRequest;
use App\Models\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserStampCorrectionRequestController extends Controller
{
    public function index()
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