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
        Schema::create('jenis_perangkat', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->comment('ODC, ODP, Closure, Tiang, ONU');
            $table->text('deskripsi')->nullable();
            $table->string('icon')->nullable()->comment('Icon untuk drag & drop');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('nama');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_perangkat');
    }
};