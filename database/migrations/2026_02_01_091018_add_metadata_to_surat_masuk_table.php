<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            // ❌ nomor_agenda JANGAN ditambah lagi, karena sudah ada migration lain

            $table->string('sifat_surat')->nullable()->after('perihal');      
            $table->string('jenis_surat')->nullable()->after('sifat_surat');  
            $table->string('klasifikasi')->nullable()->after('jenis_surat');  
            $table->string('unit_pengolah')->nullable()->after('klasifikasi');
        });
    }

    public function down(): void
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            $table->dropColumn([
                'sifat_surat',
                'jenis_surat',
                'klasifikasi',
                'unit_pengolah'
            ]);
        });
    }
};
