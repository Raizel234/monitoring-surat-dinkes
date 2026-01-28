<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // siapa yang melakukan
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // aksi apa
            $table->string('aksi'); // contoh: Tambah Surat Masuk, Edit Surat Keluar, dll
            $table->string('modul')->nullable(); // contoh: Surat Masuk, Disposisi

            // data apa yang terdampak
            $table->string('target_tipe')->nullable(); // contoh: SuratMasuk / Disposisi
            $table->unsignedBigInteger('target_id')->nullable();

            // tambahan info
            $table->text('keterangan')->nullable();

            // info request
            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
