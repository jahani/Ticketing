<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionShowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_show', function (Blueprint $table) {
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')
                ->on('sections')->onDelete('cascade');
            
            $table->integer('show_id')->unsigned();
            $table->foreign('show_id')->references('id')
                ->on('shows')->onDelete('cascade');
            
            $table->primary(['section_id', 'show_id']);
            
            $table->integer('price');

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
        Schema::dropIfExists('section_show');
    }
}
