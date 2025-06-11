<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendancesTableSeeder extends Seeder
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
        DB::table('attendances')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = User::where('role', 'user')->get();
        $startDate = Carbon::parse('2025-01-01');
        $endDate = Carbon::parse('2025-05-30');

        foreach ($users as $user) {
            $date = $startDate->copy();

            while ($date->lte($endDate)) {
                if ($date->isWeekday()) {
                    DB::table('attendances')->insert([
                        'user_id' => $user->id,
                        'attendance_date' => $date->toDateString(),
                        'clock_in' => $date->copy()->setTime(9, 0),
                        'clock_out' => $date->copy()->setTime(18, 0),
                        'status' => '出勤中',
                        'total_work_time' => 480,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                $date->addDay();
            }
        }
    }
}
