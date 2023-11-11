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
        Schema::create('detail_arisan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('arisan_id');
            $table->unsignedBigInteger('peserta_id');
            $table->string('nominal');
            $table->timestamps();
            $table->foreign('arisan_id')->references('id')->on('arisan')->onDelete('cascade');
            $table->foreign('peserta_id')->references('id')->on('peserta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_arisan');
    }
};
