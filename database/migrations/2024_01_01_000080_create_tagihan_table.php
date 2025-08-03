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
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->cascadeOnDelete();
            $table->string('nomor_tagihan')->unique();
            $table->date('periode_mulai');
            $table->date('periode_akhir');
            $table->decimal('jumlah_tagihan', 10, 2);
            $table->decimal('denda', 10, 2)->default(0);
            $table->decimal('total_bayar', 10, 2);
            $table->date('tanggal_jatuh_tempo');
            $table->enum('status', ['pending', 'paid', 'overdue', 'cancelled'])->default('pending');
            $table->timestamps();
            
            $table->index(['pelanggan_id', 'status']);
            $table->index(['status', 'tanggal_jatuh_tempo']);
            $table->index('nomor_tagihan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};