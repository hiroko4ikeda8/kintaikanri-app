<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyApplicationDateNullableInAttendanceCorrectRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_correct_requests', function (Blueprint $table) {
            $table->date('application_date')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_correct_requests', function (Blueprint $table) {
            $table->date('application_date')->nullable()->change();
        });
    }
}
