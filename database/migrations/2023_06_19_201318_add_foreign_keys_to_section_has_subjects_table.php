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
        Schema::table('section_has_subjects', function (Blueprint $table) {
            $table->foreign(['id_section'], 'fk_secs_id_section')->references(['id'])->on('sections');
            $table->foreign(['id_subject'], 'fk_secs_id_subject')->references(['id'])->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('section_has_subjects', function (Blueprint $table) {
            $table->dropForeign('fk_secs_id_section');
            $table->dropForeign('fk_secs_id_subject');
        });
    }
};
