<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BreakTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // `attendances` テーブルの全IDを取得
        $attendanceIds = DB::table('attendances')->pluck('id');

        foreach ($attendanceIds as $attendanceId) {
            DB::table('break_times')->insert([
                'attendance_id' => $attendanceId,
                'break_start' => '12:00:00', // 休憩開始（固定）
                'break_end' => '13:00:00',   // 休憩終了（固定）
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
