<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatShowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_show', function (Blueprint $table) {
            $table->integer('seat_id')->unsigned();
            $table->foreign('seat_id')->references('id')
                ->on('seats')->onDelete('cascade');
            
            $table->integer('show_id')->unsigned();
            $table->foreign('show_id')->references('id')
                ->on('shows')->onDelete('cascade');
            
            $table->enum('status', ['held', 'reserved', 'booked']);
            
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('seat_show');
    }
}
