<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            $table->foreignId('tujuan_user_id')->nullable()->after('unit_pengolah')->constrained('users')->nullOnDelete();
            $table->string('klasifikasi_manual')->nullable()->after('tujuan_user_id');
        });
    }

    public function down(): void
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            $table->dropConstrainedForeignId('tujuan_user_id');
            $table->dropColumn('klasifikasi_manual');
        });
    }
};
