<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('new_confirmed')->nullable(true);
            $table->integer('total_confirmed')->nullable(true);
            $table->integer('new_deaths')->nullable(true);
            $table->integer('total_deaths')->nullable(true);
            $table->integer('new_recovered')->nullable(true);
            $table->integer('total_recovered')->nullable(true);
            $table->dateTime('date')->nullable(true);
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
        Schema::dropIfExists('global_stats');
    }
}
