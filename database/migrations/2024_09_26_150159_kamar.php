<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->increments('id_kamar');
            $table->string('no_kamar');
            $table->integer('price')->unsigned();
            $table->string('image_kamar', 255);
            $table->String('status_kamar')->default('tersedia');
            $table->integer('category_id')->unsigned();
            $table->timestamps();
        });

   

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
