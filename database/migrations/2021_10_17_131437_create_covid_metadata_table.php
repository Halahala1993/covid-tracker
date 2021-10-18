<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_metadata', function (Blueprint $table) {
            $table->increments('id');
            $table->string('countries');
            $table->string('states');
            $table->string('states_us');
            $table->string('counties');
            $table->string('iso3s');
            $table->integer('uids');
            $table->string('first_date');
            $table->string('last_date');
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
        Schema::dropIfExists('covid_metadata');
    }
}
