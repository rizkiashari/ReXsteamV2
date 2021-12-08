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
            $table->id();
            $table->foreignId('category_id');
            $table->string('game_name', 100)->unique();
            $table->string('slug', 100)->unique();
            $table->text('description');
            $table->longText('long_description');
            $table->string('developer', 100);
            $table->string('publisher', 100);
            $table->integer('price');
            $table->string('cover');
            $table->string('trailer');
            $table->tinyInteger('is_adult')->default(0);
            $table->date('release_date');
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
