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
        Schema::create('pemesanan_permainans', function (Blueprint $table) {
            $table->id();
            $table->string("permainan_id");
            $table->string("nama");
            $table->date("tanggal");
            $table->string("jam_mulai");
            $table->string("jam_selesai");
            $table->string("jumlah");
            $table->string("detail");
            $table->enum('ket', ['belum', 'sedang', 'selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_permainans');
    }
};
