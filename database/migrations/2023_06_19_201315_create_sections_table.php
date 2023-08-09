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
        Schema::create('sections', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_sectiontype')->index('fk_sec_id_tpsec');
            $table->integer('id_period')->index('fk_sec_id_period');
            $table->integer('id_level')->index('fk_s_id_level');
            $table->string('section_name', 50);
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
        Schema::dropIfExists('sections');
    }
};
