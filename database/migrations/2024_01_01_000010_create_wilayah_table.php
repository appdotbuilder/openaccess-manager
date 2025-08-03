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
        Schema::create('wilayah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wilayah');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('koordinat_lat')->nullable()->comment('Latitude koordinat lokasi');
            $table->string('koordinat_lng')->nullable()->comment('Longitude koordinat lokasi');
            $table->enum('status', ['draft', 'completed'])->default('draft');
            $table->timestamps();
            
            $table->index(['provinsi', 'kota']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayah');
    }
};