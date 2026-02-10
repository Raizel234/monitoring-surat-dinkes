<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('surat_keluar', function (Blueprint $table) {

            if (!Schema::hasColumn('surat_keluar', 'nomor_agenda')) {
                $table->string('nomor_agenda')->nullable()->after('id');
            }

            if (!Schema::hasColumn('surat_keluar', 'jenis_surat')) {
                $table->string('jenis_surat')->default('lembar_kendali')->after('perihal');
            }

            if (!Schema::hasColumn('surat_keluar', 'kategori_surat')) {
                $table->string('kategori_surat')->nullable()->after('jenis_surat');
            }

            if (!Schema::hasColumn('surat_keluar', 'sifat_surat')) {
                $table->string('sifat_surat')->nullable()->after('kategori_surat');
            }

            if (!Schema::hasColumn('surat_keluar', 'klasifikasi')) {
                $table->string('klasifikasi')->nullable()->after('sifat_surat');
            }

            if (!Schema::hasColumn('surat_keluar', 'unit_pengolah')) {
                $table->string('unit_pengolah')->nullable()->after('klasifikasi');
            }

            if (!Schema::hasColumn('surat_keluar', 'yth')) {
                $table->string('yth')->nullable()->after('unit_pengolah');
            }

            if (!Schema::hasColumn('surat_keluar', 'dari')) {
                $table->string('dari')->nullable()->after('yth');
            }

            if (!Schema::hasColumn('surat_keluar', 'tembusan')) {
                $table->text('tembusan')->nullable()->after('dari');
            }

            if (!Schema::hasColumn('surat_keluar', 'lampiran')) {
                $table->string('lampiran')->nullable()->after('tembusan');
            }

            if (!Schema::hasColumn('surat_keluar', 'isi')) {
                $table->text('isi')->nullable()->after('lampiran');
            }

            if (!Schema::hasColumn('surat_keluar', 'jabatan_ttd')) {
                $table->string('jabatan_ttd')->nullable()->after('isi');
            }

            if (!Schema::hasColumn('surat_keluar', 'nama_ttd')) {
                $table->string('nama_ttd')->nullable()->after('jabatan_ttd');
            }

            if (!Schema::hasColumn('surat_keluar', 'nip_ttd')) {
                $table->string('nip_ttd')->nullable()->after('nama_ttd');
            }

            if (!Schema::hasColumn('surat_keluar', 'pangkat_ttd')) {
                $table->string('pangkat_ttd')->nullable()->after('nip_ttd');
            }

            if (!Schema::hasColumn('surat_keluar', 'qr_token')) {
                $table->string('qr_token')->nullable()->after('pangkat_ttd');
            }
        });

        // optional: unique index untuk qr_token (biar aman)
        try {
            Schema::table('surat_keluar', function (Blueprint $table) {
                $table->unique('qr_token', 'surat_keluar_qr_token_unique');
            });
        } catch (\Throwable $e) {}
    }

    public function down(): void
    {
        // sengaja kosong (aman untuk magang)
    }
};
