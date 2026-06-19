<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            $table->string('nomor_agenda', 50)->nullable()->unique()->after('nomor_surat');
        });

        if (Schema::hasTable('surat_keluar')) {
            Schema::table('surat_keluar', function (Blueprint $table) {
                $table->string('nomor_agenda', 50)->nullable()->unique()->after('nomor_surat');
            });
        } elseif (Schema::hasTable('surat_keluars')) {
            Schema::table('surat_keluars', function (Blueprint $table) {
                $table->string('nomor_agenda', 50)->nullable()->unique()->after('nomor_surat');
            });
        }
    }

    public function down(): void
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            $table->dropUnique(['nomor_agenda']);
            $table->dropColumn('nomor_agenda');
        });

        $tableName = Schema::hasTable('surat_keluar') ? 'surat_keluar' : 'surat_keluars';
        if (Schema::hasTable($tableName)) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropUnique(['nomor_agenda']);
                $table->dropColumn('nomor_agenda');
            });
        }
    }
};
