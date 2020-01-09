<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('pegi')->unsigned()->nullable();
            $table->date('date')->nullable();
            $table->boolean('physical_release')->default(false);
            $table->decimal('price',5,2)->default(0);
            $table->unsignedBigInteger('developper_id')->nullable();
            $table->foreign('developper_id')->references('id')->on('developpers');
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
        Schema::dropIfExists('games');
    }
}
