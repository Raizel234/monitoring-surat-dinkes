<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

if (!function_exists('logAktivitas')) {
    function logAktivitas(
        string $aksi,
        string $modul,
        string $targetType,
        int $targetId,
        string $keterangan
    ) {
        ActivityLog::create([
            'user_id'     => Auth::id(),
            'aksi'        => $aksi,
            'modul'       => $modul,
            'target_type' => $targetType,
            'target_id'   => $targetId,
            'keterangan'  => $keterangan,
            'ip'          => Request::ip(),
            'user_agent'  => Request::header('User-Agent'),
        ]);
    }
}
