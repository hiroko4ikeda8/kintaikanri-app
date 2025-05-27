<?php

namespace App\Http\Controllers\User;

use App\Models\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserStampCorrectionRequestController extends Controller
{
    public function index()
    {
        return view('stamp_correction_request.index');
    }
}
