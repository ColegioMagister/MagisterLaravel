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
        Schema::table('student_quota', function (Blueprint $table) {
            $table->foreign(['id_quota'], 'fk_stuq_id_quota')->references(['id'])->on('quotas');
            $table->foreign(['id_student'], 'fk_stuq_id_student')->references(['id'])->on('student_in_section');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_quota', function (Blueprint $table) {
            $table->dropForeign('fk_stuq_id_quota');
            $table->dropForeign('fk_stuq_id_student');
        });
    }
};
