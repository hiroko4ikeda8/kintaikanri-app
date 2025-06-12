<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceCorrectRequestsTableSeeder extends Seeder
{
    // 省略

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('attendance_correct_requests')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = User::where('role', 'user')->get();

        $days = [1, 15];
        foreach ($users as $user) {
            for ($month = 1; $month <= 5; $month++) {
                foreach ($days as $day) {
                    $date = Carbon::create(2025, $month, $day);
                    echo "Checking user {$user->id}, target date: {$date->toDateString()}\n";
                    $attendance = Attendance::where('user_id', $user->id)
                        ->whereDate('attendance_date', $date->toDateString())
                        ->first();
                    if ($attendance) {
                        DB::table('attendance_correct_requests')->insert([
                            'user_id' => $user->id,
                            'attendance_id' => $attendance->id,
                            'application_date' => $date->copy()->addDay()->toDateString(),
                            'correct_clock_in' => '09:00:00',
                            'correct_clock_out' => '18:00:00',
                            'remarks' => '遅延のため',
                            'status' => 'pending',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}

