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
            $table->float('price', 8, 2)->nullable();
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('person_id');
            $table->integer('period');
            $table->timestamps();

            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->foreign('person_id')->references('id')->on('people');
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
