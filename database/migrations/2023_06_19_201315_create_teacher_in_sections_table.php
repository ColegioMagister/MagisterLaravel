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
        Schema::create('teacher_in_sections', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_teacher')->index('fk_teas_id_teacher');
            $table->integer('id_section')->index('fk_teas_id_section');
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
        Schema::dropIfExists('teacher_in_sections');
    }
};
