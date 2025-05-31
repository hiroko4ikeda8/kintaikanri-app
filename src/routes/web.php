<?php


use App\Http\Controllers\Admin\StampCorrectionRequestController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\User\UserStampCorrectionRequestController;
use App\Http\Controllers\User\UserAttendanceController;
use App\Http\Controllers\AuthController;
use App\Models\User;
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

// 管理者用トップページ
Route::get('/admin/attendance/list', [AttendanceController::class, 'index'])->name('admin.attendance.list');
Route::get('/admin/attendance/{id}', [AttendanceController::class, 'show'])->name('admin.attendance.show');
Route::get('/admin/staff/list', [StaffController::class, 'index'])->name('admin.staff.index');
Route::get('/admin/attendance/staff/{id}', [StaffController::class, 'showAttendances'])->name('admin.staff.attendance.show');
// 管理者側（一覧・承認）
// Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/stamp_correction_request/list', [StampCorrectionRequestController::class, 'index'])->name('admin.stamp_correction_request.list');
    Route::get('/admin/stamp_correction_request/approve/{id}', [StampCorrectionRequestController::class, 'approve']);
// });



// 一般ユーザー登録ページ
Route::get('/user/attendance', [UserAttendanceController::class, 'create'])->name('user.attendance.create');
Route::get('/user/attendance/list', [UserAttendanceController::class, 'index'])->middleware('auth')->name('user.attendance.list');
Route::get('/user/attendance/{id}', [UserAttendanceController::class, 'show'])->name('attendance.show');
// ユーザー申請用
// Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/stamp_correction_request/list', [UserStampCorrectionRequestController::class, 'index'])->name('user.stamp_correction_request.list');
    Route::post('/user/stamp_correction_request/store', [UserStampCorrectionRequestController::class, 'store']);
// });
