<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            if (!Schema::hasColumn('surat_masuks', 'qr_token')) {
                $table->string('qr_token', 64)->nullable()->after('file_surat');
                $table->unique('qr_token', 'surat_masuks_qr_token_unique');
            }
        });

        Schema::table('surat_keluar', function (Blueprint $table) {
            if (!Schema::hasColumn('surat_keluar', 'qr_token')) {
                $table->string('qr_token', 64)->nullable()->after('file_surat');
                $table->unique('qr_token', 'surat_keluar_qr_token_unique');
            }
        });
    }

    public function down(): void
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            $table->dropUnique('surat_masuks_qr_token_unique');
            $table->dropColumn('qr_token');
        });

        Schema::table('surat_keluar', function (Blueprint $table) {
            $table->dropUnique('surat_keluar_qr_token_unique');
            $table->dropColumn('qr_token');
        });
    }
};
