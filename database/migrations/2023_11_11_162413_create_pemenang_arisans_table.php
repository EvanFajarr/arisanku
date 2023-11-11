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
        Schema::create('pemenang_arisans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('arisan_id')->unique();
            $table->unsignedBigInteger('peserta_id')->unique();
            $table->foreign('arisan_id')->references('id')->on('arisan')->onDelete('cascade');
            $table->foreign('peserta_id')->references('id')->on('peserta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemenang_arisans');
    }
};
