<?php
namespace App\Helper;

class ViewHelper {
    public static function isSpDevice(): bool {
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
        return (bool) preg_match(
            '/(iPhone|iPod|Android.*Mobile|Windows Phone|BlackBerry|Opera Mini|IEMobile|Mobile Safari)/i',
            $ua
        );
    }

    public static function pickTemplatePath(string $base): string {
        $sp_abs = __DIR__ . '/../../templates/sp/' . $base . '.tpl';
        if (self::isSpDevice() && file_exists($sp_abs)) {
            return 'sp/' . $base . '.tpl';
        }
        return $base . '.tpl';
    }
}
