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
        Schema::table('sections', function (Blueprint $table) {
            $table->foreign(['id_level'], 'fk_s_id_level')->references(['id'])->on('levels');
            $table->foreign(['id_sectiontype'], 'fk_sec_id_tpsec')->references(['id'])->on('section_type');
            $table->foreign(['id_period'], 'fk_sec_id_period')->references(['id'])->on('school_periods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropForeign('fk_s_id_level');
            $table->dropForeign('fk_sec_id_tpsec');
            $table->dropForeign('fk_sec_id_period');
        });
    }
};
