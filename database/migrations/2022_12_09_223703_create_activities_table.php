<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('departure_place');
            $table->time('departure_time');
            $table->string('return_place');
            $table->time('return_time');
            $table->json('essentials');
            $table->float('price', 8, 2);
            $table->integer('max_participants')->default(0);
            $table->integer('participants')->default(0);
            $table->text('description');
            $table->string('image');
            $table->boolean('visible');
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
        Schema::dropIfExists('activities');
    }
};
