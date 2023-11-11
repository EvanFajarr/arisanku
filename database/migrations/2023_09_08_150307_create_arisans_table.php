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
        Schema::create('arisan', function (Blueprint $table) {
            $table->id();
           // $table->unsignedBigInteger('peserta_id');
       $table->string('nominal');
        $table->date('tanggal_pelaksanaan');
       // $table->string('status')->default('pending');
        $table->text('keterangan')->nullable();
     //   $table->string('tempat_pelaksanaan')->nullable();
     $table->unsignedBigInteger('tempat_pelaksanaan')->nullable();
        $table->timestamps();

        $table->foreign('tempat_pelaksanaan')->references('id')->on('peserta');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arisan');
    }
};
