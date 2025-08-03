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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pelanggan')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('telepon');
            $table->text('alamat');
            $table->foreignId('paket_internet_id')->constrained('paket_internet');
            $table->foreignId('wilayah_id')->constrained('wilayah');
            $table->string('username_pppoe')->unique()->nullable();
            $table->string('password_pppoe')->nullable();
            $table->string('ip_address')->nullable();
            $table->enum('status', ['aktif', 'non_aktif', 'expired', 'suspend'])->default('aktif');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->timestamps();
            
            $table->index(['status', 'tanggal_berakhir']);
            $table->index('kode_pelanggan');
            $table->index('wilayah_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};