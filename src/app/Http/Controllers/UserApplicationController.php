<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class UserApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::where('user_id', auth()->id())->get();
        return view('application.index', compact('applications'));
    }
}
