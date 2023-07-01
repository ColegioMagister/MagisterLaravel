<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_info', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('school_name', 50);
            $table->string('tax_number', 50);
            $table->string('email', 100);
            $table->string('phone_number', 50);
            $table->string('city', 50);
            $table->string('adress', 100);
            $table->string('url_img', 200);
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
        Schema::dropIfExists('school_info');
    }
}
