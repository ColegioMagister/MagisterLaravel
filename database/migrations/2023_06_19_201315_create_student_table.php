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
        Schema::create('student', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 50);
            $table->string('lastname', 50);
            $table->date('bithdate');
            $table->string('gender', 10);
            $table->string('phone_number', 50);
            $table->string('dni', 30);
            $table->string('url_img', 250);
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
        Schema::dropIfExists('student');
    }
};
