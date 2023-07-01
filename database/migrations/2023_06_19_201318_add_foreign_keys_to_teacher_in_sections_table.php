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
        Schema::table('teacher_in_sections', function (Blueprint $table) {
            $table->foreign(['id_section'], 'fk_teas_id_section')->references(['id'])->on('sections');
            $table->foreign(['id_teacher'], 'fk_teas_id_teacher')->references(['id'])->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_in_sections', function (Blueprint $table) {
            $table->dropForeign('fk_teas_id_section');
            $table->dropForeign('fk_teas_id_teacher');
        });
    }
};
