<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AttendanceCorrectRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->get();
        $attendances = DB::table('attendances')->get();

        foreach ($users as $user) {
            $attendance = $attendances->random();

            // 修正申請
            $requestId = DB::table('attendance_correct_requests')->insertGetId([
                'user_id' => $user->id,
                'attendance_id' => $attendance->id,
                'correct_clock_in' => '09:30:00',
                'correct_clock_out' => '18:30:00',
                'remarks' => '遅延のため',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 修正休憩（例として休憩1と休憩2）
            DB::table('attendance_correct_breaks')->insert([
                [
                    'attendance_correct_request_id' => $requestId,
                    'correct_break_start' => '12:00:00',
                    'correct_break_end' => '12:30:00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'attendance_correct_request_id' => $requestId,
                    'correct_break_start' => '15:00:00',
                    'correct_break_end' => '15:15:00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
