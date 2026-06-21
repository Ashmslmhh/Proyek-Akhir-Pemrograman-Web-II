<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users untuk mahasiswa
            $table->foreignId('mahasiswa_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Relasi ke tabel users untuk dosen
            $table->foreignId('dosen_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Kolom sesuai form UI kamu
            $table->date('tanggal');
            $table->string('sesi_waktu');
            $table->string('topik');
            $table->text('catatan');
            
            // Status pengajuan
            $table->enum('status', [
                'Menunggu',
                'Disetujui',
                'Ditolak'
            ])->default('Menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};