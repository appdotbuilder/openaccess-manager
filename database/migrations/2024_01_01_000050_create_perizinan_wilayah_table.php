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
        Schema::create('perizinan_wilayah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->string('nama_dokumen');
            $table->string('file_path');
            $table->string('file_type');
            $table->enum('status_izin', ['diproses', 'disetujui', 'ditolak'])->default('diproses');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            $table->index(['wilayah_id', 'status_izin']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perizinan_wilayah');
    }
};