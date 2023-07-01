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
        Schema::create('teacher_has_subjects', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_teacher')->index('fk_ts_id_teacher');
            $table->integer('id_subject')->index('fk_ts_id_subject');
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
        Schema::dropIfExists('teacher_has_subjects');
    }
};
