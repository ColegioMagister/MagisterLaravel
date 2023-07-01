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
        Schema::create('section_has_subjects', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_subject')->index('fk_secs_id_subject');
            $table->integer('id_section')->index('fk_secs_id_section');
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
        Schema::dropIfExists('section_has_subjects');
    }
};
