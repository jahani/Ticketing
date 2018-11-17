<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('row_number');
            $table->unsignedTinyInteger('seat_number');
            $table->unsignedInteger('section_id');
            $table->timestamps();
            
            $table->foreign('section_id')->references('id')
                ->on('sections')->onDelete('cascade');
            $table->unique(['row_number', 'seat_number', 'section_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
