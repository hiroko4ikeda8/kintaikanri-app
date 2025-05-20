<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function showUserLoginForm()
    {
        return view('auth.user-login');
    }

    public function register(RegisterRequest $request)
    {
        // バリデーション済みのデータ
        $validated = $request->validated();

        // ユーザー作成などの処理
    }

    public function adminLogin(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/attendance/list');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => '管理者アカウントではありません。']);
            }
        }

        return back()->withErrors(['email' => '認証に失敗しました。']);
    }

    public function userLogin(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'user') {
                return redirect()->intended('/attendance');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => '一般ユーザーアカウントではありません。']);
            }
        }

        return back()->withErrors(['email' => '認証に失敗しました。']);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login'); // または適切なトップページなど
    }
}
