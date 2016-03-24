<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketTable extends Migration
{
    // up() defines the function that is executed when the migration is run
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gid');
            $table->integer('referenceId');
            $table->string('town');
            $table->integer('size');
            $table->string('management');
            $table->boolean('monday');
            $table->string('tuesday');
            $table->string('wednesday');
            $table->string('thursday');
            $table->string('friday');
            $table->string('saturday');
            $table->string('sunday');
            $table->string('description', 255);
            $table->float('xLocation', 20, 17);
            $table->float('yLocation', 20, 17);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    // down() defines the function that is executed when you run migration rollback
    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down() {
        Schema::drop('market');
    }
}
