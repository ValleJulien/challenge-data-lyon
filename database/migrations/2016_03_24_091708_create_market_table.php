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
            $table->string('name', 255);
            $table->integer('surface');
            $table->string('management');
            $table->date('brew_date');
            $table->boolean('monday');
            $table->boolean('tuesday');
            $table->boolean('wednesday');
            $table->boolean('thursday');
            $table->boolean('friday');
            $table->boolean('saturday');
            $table->boolean('sunday');
            $table->string('opening');
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
