<?php

if (!function_exists('bulanRomawi')) {
    function bulanRomawi(int $bulan): string
    {
        $romawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        return $romawi[$bulan] ?? 'I';
    }
}

if (!function_exists('generateNomorAgenda')) {
    /**
     * @param string $prefix Contoh: AGM atau AGK
     * @param int $urutan Nomor urut (1,2,3...)
     * @param string $tanggal Format Y-m-d
     */
    function generateNomorAgenda(string $prefix, int $urutan, string $tanggal): string
    {
        $bulan = (int) date('n', strtotime($tanggal));
        $tahun = (int) date('Y', strtotime($tanggal));

        $no = str_pad((string) $urutan, 4, '0', STR_PAD_LEFT);
        $romawi = bulanRomawi($bulan);

        return "{$prefix}-{$no}/{$romawi}/{$tahun}";
    }
}
