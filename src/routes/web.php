<?php

use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\UserAttendanceController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 会員登録フォーム表示
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
// 一般ユーザー用ログインフォーム表示
Route::get('/login', [AuthController::class, 'showUserLoginForm'])->name('login');
// POST /login に対応
Route::post('/login', [AuthController::class, 'userLogin'])->name('user.login');


// 管理者用ログインフォーム表示
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login.form');
// POST /admin/login に対応
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');

// 本番用：POSTメソッドでログアウト
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 開発用（後で本番時にはコメントアウトまたは削除）
Route::get('/logout', [AuthController::class, 'logout']); // 開発中のみ使用
// ↑ 開発中はGETでログアウトしていたが、本番環境では使用しないこと！

Route::get('/admin/attendance', [AdminAttendanceController::class, 'index']);
Route::get('/attendance', [UserAttendanceController::class, 'index']);