<?php

if (!function_exists('format_rupiah')) {
    function format_rupiah($angka)
    {
        if (!$angka || $angka == 0) {
            return 'Tidak disebutkan';
        }
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}
