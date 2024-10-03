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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments("category_id"); 
            $table->string('name_type'); 
            $table->string('tipe_kamar', 255);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::table('kamars', function (Blueprint $table) {
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types');
    }
};
