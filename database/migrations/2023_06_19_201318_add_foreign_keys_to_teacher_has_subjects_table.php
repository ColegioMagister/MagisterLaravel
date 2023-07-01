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
        Schema::table('teacher_has_subjects', function (Blueprint $table) {
            $table->foreign(['id_subject'], 'fk_ts_id_subject')->references(['id'])->on('subjects');
            $table->foreign(['id_teacher'], 'fk_ts_id_teacher')->references(['id'])->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_has_subjects', function (Blueprint $table) {
            $table->dropForeign('fk_ts_id_subject');
            $table->dropForeign('fk_ts_id_teacher');
        });
    }
};
