<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        // バリデーション済みのデータを取得
        $validated = $request->validated();

        // ユーザーを作成
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user', // 必要ならデフォルトのロールを指定
        ]);

        // 自動ログインさせたい場合は以下を追加
        Auth::login($user);

        // 登録後にリダイレクト
        return redirect('/attendance'); // or 適切なトップページ
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
                return redirect()->route('user.attendance.create'); // ← 勤怠登録UIへリダイレクト
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
