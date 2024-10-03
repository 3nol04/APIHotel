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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->uuid('id_transaksi');
            $table->increments('id_kamar');
            $table->uuid('id_pelanggan');
            $table->timestamps();
        });
        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreign('id_kamar')->references('id_kamar')->on('kamars')->onDelete('cascade'); // Menghubungkan ke tabel kamars
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans')->onDelete('cascade'); // Menghubungkan ke tabel pelanggans
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
