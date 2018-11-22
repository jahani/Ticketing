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
            $table->unsignedInteger('seat_id')->index();
            $table->unsignedInteger('show_id')->index();
            $table->unsignedTinyInteger('status');
            $table->string('session_id', 100)->nullable()->index();
            $table->unsignedInteger('user_id')->nullable()->index();
            $table->timestamps();

            $table->primary(['seat_id', 'show_id']);
            $table->foreign('seat_id')->references('id')
                ->on('seats')->onDelete('restrict');
            $table->foreign('show_id')->references('id')
                ->on('shows')->onDelete('restrict');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('restrict');
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
