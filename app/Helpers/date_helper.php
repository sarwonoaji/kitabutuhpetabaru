<?php

use Carbon\Carbon;

if (! function_exists('format_tanggal_id')) {
    /**
     * Format date to Indonesian long format, e.g. "08 Februari 2025".
     * Accepts string, timestamp, or DateTimeInterface.
     */
    function format_tanggal_id($date)
    {
        if (empty($date)) {
            return '';
        }

        try {
            $dt = null;
            if ($date instanceof DateTimeInterface) {
                $dt = Carbon::instance($date);
            } else {
                $dt = Carbon::parse($date);
            }

            return $dt->locale('id')->translatedFormat('d F Y');
        } catch (\Throwable $e) {
            return (string) $date;
        }
    }
}
