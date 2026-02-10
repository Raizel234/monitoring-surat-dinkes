<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            // ===== KHUSUS NOTA DINAS (tabel isi) =====
            $table->string('rujukan_nomor')->nullable()->after('isi');   // nomor surat rujukan
            $table->string('rujukan_perihal')->nullable()->after('rujukan_nomor');

            $table->string('nama_peneliti')->nullable()->after('rujukan_perihal');
            $table->string('npm')->nullable()->after('nama_peneliti');
            $table->string('tentang')->nullable()->after('npm');
            $table->string('nama_lembaga')->nullable()->after('tentang');
        });
    }

    public function down(): void
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            $table->dropColumn([
                'rujukan_nomor',
                'rujukan_perihal',
                'nama_peneliti',
                'npm',
                'tentang',
                'nama_lembaga',
            ]);
        });
    }
};
