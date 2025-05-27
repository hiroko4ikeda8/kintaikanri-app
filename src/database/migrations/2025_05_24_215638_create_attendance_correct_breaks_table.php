<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceCorrectBreaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_correct_breaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_correct_request_id')->constrained('attendance_correct_requests')->onDelete('cascade');
            $table->time('correct_break_start')->nullable();
            $table->time('correct_break_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_correct_breaks');
    }
}
