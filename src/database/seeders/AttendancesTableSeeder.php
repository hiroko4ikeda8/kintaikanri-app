<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 6人のユーザーのIDを取得
        $userIds = DB::table('users')->pluck('id');

        // 今日から過去180日分
        $days = 180;

        foreach ($userIds as $userId) {
            for ($i = 0; $i < $days; $i++) {
                DB::table('attendances')->insert([
                    'user_id' => $userId,
                    'clock_in' => '09:00:00',
                    'clock_out' => '18:00:00',
                    'status' => '勤務中',
                    'attendance_date' => Carbon::now()->subDays($i)->toDateString(),
                    'total_work_time' => 540,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
