<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('surat_keluar')) {
            return;
        }

        Schema::table('surat_keluar', function (Blueprint $table) {
            if (!Schema::hasColumn('surat_keluar', 'sifat_surat')) {
                $table->string('sifat_surat')->nullable()->after('perihal');
            }
            if (!Schema::hasColumn('surat_keluar', 'jenis_surat')) {
                $table->string('jenis_surat')->nullable()->after('sifat_surat');
            }
            if (!Schema::hasColumn('surat_keluar', 'klasifikasi')) {
                $table->string('klasifikasi')->nullable()->after('jenis_surat');
            }
            if (!Schema::hasColumn('surat_keluar', 'unit_pengolah')) {
                $table->string('unit_pengolah')->nullable()->after('klasifikasi');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('surat_keluar')) {
            return;
        }

        Schema::table('surat_keluar', function (Blueprint $table) {
            $columns = ['sifat_surat', 'jenis_surat', 'klasifikasi', 'unit_pengolah'];
            foreach ($columns as $col) {
                if (Schema::hasColumn('surat_keluar', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
