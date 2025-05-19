<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // usersテーブルからユーザーIDを取得
        $userIds = DB::table('users')->pluck('id');

        // attendancesテーブルから出勤データのIDを取得
        $attendanceIds = DB::table('attendances')->pluck('id');

        foreach ($userIds as $userId) {
            for ($i = 0; $i < 3; $i++) {
                DB::table('applications')->insert([
                    'user_id' => $userId,
                    'attendance_id' => $attendanceIds->random(),
                    'remarks' => '遅延のため',
                    'status' => 'pending',
                    'application_date' => now()->subDays(rand(0, 30))->toDateString(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
