<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemediesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remedies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('dosage', 6);
            $table->float('price', 8, 2);
            $table->unsignedBigInteger('schedule');
            $table->unsignedBigInteger('person');
            $table->integer('period');
            $table->timestamps();

            $table->foreign('schedule')->references('id')->on('schedules');
            $table->foreign('person')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('remedies');
    }
}
