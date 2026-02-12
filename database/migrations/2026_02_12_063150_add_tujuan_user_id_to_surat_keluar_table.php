<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            $table->foreignId('tujuan_user_id')
                ->nullable()
                ->after('tujuan')
                ->constrained('users')
                ->nullOnDelete();

            // opsional: kalau kamu mau tetap simpan teks tujuan manual
            // $table->string('tujuan_text')->nullable()->after('tujuan_user_id');
        });
    }

    public function down(): void
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            $table->dropConstrainedForeignId('tujuan_user_id');
            // $table->dropColumn('tujuan_text');
        });
    }
};
