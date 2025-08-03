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
        Schema::create('perangkat_jaringan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->cascadeOnDelete();
            $table->foreignId('jenis_perangkat_id')->constrained('jenis_perangkat');
            $table->string('nama_perangkat');
            $table->string('koordinat_x')->nullable()->comment('Posisi X pada desain wilayah');
            $table->string('koordinat_y')->nullable()->comment('Posisi Y pada desain wilayah');
            $table->text('spesifikasi')->nullable();
            $table->enum('status', ['draft', 'installed', 'maintenance', 'inactive'])->default('draft');
            $table->timestamps();
            
            $table->index(['wilayah_id', 'jenis_perangkat_id']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkat_jaringan');
    }
};