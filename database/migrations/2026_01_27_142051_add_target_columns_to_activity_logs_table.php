<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('activity_logs', 'target_type')) {
                $table->string('target_type')->nullable()->after('modul');
            }
            if (!Schema::hasColumn('activity_logs', 'target_id')) {
                $table->unsignedBigInteger('target_id')->nullable()->after('target_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            if (Schema::hasColumn('activity_logs', 'target_id')) {
                $table->dropColumn('target_id');
            }
            if (Schema::hasColumn('activity_logs', 'target_type')) {
                $table->dropColumn('target_type');
            }
        });
    }
};

