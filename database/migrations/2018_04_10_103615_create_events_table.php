<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('userid');
            $table->string('name');
            $table->string('type');
            $table->text('description');
            $table->date('date');
            $table->time('time');
            $table->string('venue');
            $table->integer('likeness')->default(0);
            $table->string('imgLoc');
            $table->foreign('userid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
