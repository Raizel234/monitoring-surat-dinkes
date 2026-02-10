<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('surat_keluar', function (Blueprint $table) {

            // ===== Field umum (template selector) =====
            if (!Schema::hasColumn('surat_keluar', 'jenis_surat')) {
                $table->string('jenis_surat')->default('lembar_kendali'); // lembar_kendali | nota_dinas | surat_keputusan
            }

            if (!Schema::hasColumn('surat_keluar', 'sifat_surat')) {
                $table->string('sifat_surat')->nullable();
            }

            if (!Schema::hasColumn('surat_keluar', 'klasifikasi')) {
                $table->string('klasifikasi')->nullable();
            }

            if (!Schema::hasColumn('surat_keluar', 'unit_pengolah')) {
                $table->string('unit_pengolah')->nullable();
            }

            // ===== Nota dinas fields =====
            if (!Schema::hasColumn('surat_keluar', 'yth')) {
                $table->string('yth')->nullable();
            }

            if (!Schema::hasColumn('surat_keluar', 'dari')) {
                $table->string('dari')->nullable();
            }

            if (!Schema::hasColumn('surat_keluar', 'tembusan')) {
                $table->text('tembusan')->nullable();
            }

            if (!Schema::hasColumn('surat_keluar', 'tanggal_surat')) {
                $table->date('tanggal_surat')->nullable();
            }

            if (!Schema::hasColumn('surat_keluar', 'lampiran')) {
                $table->string('lampiran')->nullable();
            }

            if (!Schema::hasColumn('surat_keluar', 'isi')) {
                $table->text('isi')->nullable();
            }

            // ===== TTD =====
            if (!Schema::hasColumn('surat_keluar', 'jabatan_ttd')) {
                $table->string('jabatan_ttd')->nullable();
            }

            if (!Schema::hasColumn('surat_keluar', 'nama_ttd')) {
                $table->string('nama_ttd')->nullable();
            }

            if (!Schema::hasColumn('surat_keluar', 'nip_ttd')) {
                $table->string('nip_ttd')->nullable();
            }

            if (!Schema::hasColumn('surat_keluar', 'pangkat_ttd')) {
                $table->string('pangkat_ttd')->nullable();
            }

            // ===== QR =====
            if (!Schema::hasColumn('surat_keluar', 'qr_token')) {
                $table->string('qr_token')->nullable(); // unique index dibuat terpisah agar aman
            }
        });

        // Unique index untuk qr_token (aman, tidak bikin crash kalau sudah ada)
        // Catatan: cek "index exists" di MySQL itu ribet; jadi kita coba buat dengan nama index khusus.
        // Kalau error "already exists", berarti sebelumnya sudah pernah dibuat, tinggal hapus baris ini.
        try {
            Schema::table('surat_keluar', function (Blueprint $table) {
                $table->unique('qr_token', 'surat_keluar_qr_token_unique');
            });
        } catch (\Throwable $e) {
            // abaikan kalau unique sudah ada
        }
    }

    public function down(): void
    {
        // Aman untuk project magang: jangan drop kolom existing (bisa bikin kacau kalau sudah dipakai).
        // Kalau kamu tetap mau drop kolom, aku bisa buatkan down() yang cek kolom satu-satu.
    }
};
