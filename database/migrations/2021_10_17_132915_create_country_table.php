<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country_name');
            $table->string('country_code');
            $table->string('country_slug');
            $table->integer('country_new_confirmed');
            $table->integer('country_total_confirmed');
            $table->integer('country_new_deaths');
            $table->integer('country_total_deaths');
            $table->dateTime('country_status_date')->nullable($value = true);
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
        Schema::dropIfExists('country');
    }
}
