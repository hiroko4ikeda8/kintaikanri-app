<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Attendance;
use Carbon\Carbon;

class BreakTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // 省略

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('break_times')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $attendances = Attendance::whereBetween('attendance_date', ['2025-01-01', '2025-05-30'])->get();

        foreach ($attendances as $attendance) {
            DB::table('break_times')->insert([
                'attendance_id' => $attendance->id,
                'break_start' => Carbon::parse($attendance->attendance_date)->setTime(12, 0),
                'break_end' => Carbon::parse($attendance->attendance_date)->setTime(13, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
