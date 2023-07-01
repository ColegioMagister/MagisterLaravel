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
        Schema::table('student_has_assessments', function (Blueprint $table) {
            $table->foreign(['id_assessment'], 'fk_sa_id_assessment')->references(['id'])->on('assessment');
            $table->foreign(['id_student'], 'fk_sa_id_student')->references(['id'])->on('student');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_has_assessments', function (Blueprint $table) {
            $table->dropForeign('fk_sa_id_assessment');
            $table->dropForeign('fk_sa_id_student');
        });
    }
};
