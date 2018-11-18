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
            $table->unsignedInteger('seat_id');
            $table->unsignedInteger('show_id');
            $table->unsignedTinyInteger('status_code');
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('seat_id')->references('id')
                ->on('seats')->onDelete('cascade');
            $table->foreign('show_id')->references('id')
                ->on('shows')->onDelete('cascade');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->primary(['seat_id', 'show_id']);
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
