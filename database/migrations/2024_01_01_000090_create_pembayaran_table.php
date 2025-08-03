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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tagihan_id')->constrained('tagihan')->cascadeOnDelete();
            $table->string('kode_pembayaran')->unique();
            $table->decimal('jumlah_bayar', 10, 2);
            $table->enum('metode_pembayaran', ['cash', 'transfer', 'virtual_account', 'ewallet', 'qris']);
            $table->string('referensi_pembayaran')->nullable()->comment('Reference dari payment gateway');
            $table->enum('status', ['pending', 'success', 'failed', 'cancelled'])->default('pending');
            $table->timestamp('tanggal_bayar')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            $table->index(['tagihan_id', 'status']);
            $table->index('kode_pembayaran');
            $table->index(['status', 'tanggal_bayar']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};