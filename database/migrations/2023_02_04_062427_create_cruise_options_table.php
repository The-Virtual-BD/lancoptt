<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cruise_options', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('body');
            $table->unsignedBigInteger('cruise_id');
            $table->foreign('cruise_id')->references('id')->on('cruises')->onDelete('cascade');
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
        Schema::dropIfExists('cruise_options');
    }
};
