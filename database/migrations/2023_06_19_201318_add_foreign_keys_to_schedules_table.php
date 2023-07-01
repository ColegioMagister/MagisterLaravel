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
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreign(['id_section'], 'fk_sch_id_section')->references(['id'])->on('sections');
            $table->foreign(['id_weekday'], 'fk_sch_id_weekday')->references(['id'])->on('weekdays');
            $table->foreign(['id_subject'], 'fk_sch_id_subject')->references(['id'])->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropForeign('fk_sch_id_section');
            $table->dropForeign('fk_sch_id_weekday');
            $table->dropForeign('fk_sch_id_subject');
        });
    }
};
