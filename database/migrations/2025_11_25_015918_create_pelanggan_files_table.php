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
       Schema::create('pelanggan_files', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel pelanggan (pastikan tipe data sama dengan pelanggan_id, biasanya integer/bigInteger)
        $table->unsignedInteger('pelanggan_id');
        $table->string('filename');
        $table->string('path');
        $table->timestamps();

        // Foreign Key agar jika pelanggan dihapus, fotonya juga terhapus datanya
        $table->foreign('pelanggan_id')->references('pelanggan_id')->on('pelanggan')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan_files');
    }
};
