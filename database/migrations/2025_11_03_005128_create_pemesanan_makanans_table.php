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
        Schema::create('pemesanan_makanans', function (Blueprint $table) {
            $table->id();
            $table->string("barcode_id");
            $table->string("makanan_id");
            $table->string("minuman_id");
            $table->string("jumlah");
            $table->string("detail");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_makanans');
    }
};
