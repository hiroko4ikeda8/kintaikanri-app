<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AttendanceCorrectRequestsTableSeeder extends Seeder
{
    public function run()
    {
        // 既存データを削除
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('attendance_correct_breaks')->truncate();
        DB::table('attendance_correct_requests')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = DB::table('users')->get();
        $attendances = DB::table('attendances')->get();

        foreach ($users as $user) {
            // 承認待ち：10件
            for ($i = 0; $i < 10; $i++) {
                $attendance = $attendances->random();
                $requestId = DB::table('attendance_correct_requests')->insertGetId([
                    'user_id' => $user->id,
                    'attendance_id' => $attendance->id,
                    'correct_clock_in' => '09:00:00',
                    'correct_clock_out' => '18:00:00',
                    'remarks' => '遅延のため',
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('attendance_correct_breaks')->insert([
                    [
                        'attendance_correct_request_id' => $requestId,
                        'correct_break_start' => '12:00:00',
                        'correct_break_end' => '13:00:00',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'attendance_correct_request_id' => $requestId,
                        'correct_break_start' => null,
                        'correct_break_end' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
            }

            // 承認済み：5件
            $userAttendances = $attendances->where('user_id', $user->id);
            if ($userAttendances->isEmpty()) {
                continue; // 該当ユーザーに勤怠がない場合はスキップ
            }

            for ($i = 0; $i < 5; $i++) {
                $attendance = $attendances->random();
                $requestId = DB::table('attendance_correct_requests')->insertGetId([
                    'user_id' => $user->id,
                    'attendance_id' => $attendance->id,
                    'correct_clock_in' => '09:00:00',
                    'correct_clock_out' => '18:00:00',
                    'remarks' => '遅延のため',
                    'status' => 'approved',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('attendance_correct_breaks')->insert([
                    [
                        'attendance_correct_request_id' => $requestId,
                        'correct_break_start' => '12:00:00',
                        'correct_break_end' => '13:00:00',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'attendance_correct_request_id' => $requestId,
                        'correct_break_start' => null,
                        'correct_break_end' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
            }
        }
    }
}

