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
        Schema::table('assessment', function (Blueprint $table) {
            $table->foreign(['id_section'], 'fk_a_id_section')->references(['id'])->on('sections');
            $table->foreign(['id_assessment_type'], 'fk_a_id_typ_assess')->references(['id'])->on('assessment_type');
            $table->foreign(['id_subject'], 'fk_a_id_subject')->references(['id'])->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessment', function (Blueprint $table) {
            $table->dropForeign('fk_a_id_section');
            $table->dropForeign('fk_a_id_typ_assess');
            $table->dropForeign('fk_a_id_subject');
        });
    }
};
