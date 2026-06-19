<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('halamans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('konten');
            $table->string('gambar')->nullable();
            $table->string('kategori'); // profil, layanan
            $table->string('sub_kategori')->nullable(); // visi_misi, struktur, sosmed
            $table->boolean('is_publish')->default(true);
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('halamans');
    }
};
