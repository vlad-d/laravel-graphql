<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('main_artist_id');
            $table->foreign('main_artist_id')->references('id')->on('artists')->onDelete('cascade');
            $table->string('name');
            $table->enum('genre', ['rock', 'pop', 'jazz', 'trance']);
            $table->timestamp('release_date')->nullable();
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
        Schema::dropIfExists('albums');
    }
}
