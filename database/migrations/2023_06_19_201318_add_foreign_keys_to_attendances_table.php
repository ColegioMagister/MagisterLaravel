<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreign(['id_schedule'], 'fk_at_id_schedule')->references(['id'])->on('schedules');
            $table->foreign(['id_student'], 'fk_at_id_student')->references(['id'])->on('student_in_section');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign('fk_at_id_schedule');
            $table->dropForeign('fk_at_id_student');
        });
    }
};
