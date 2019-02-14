<?php

namespace Truehero;

class Utils
{
    /**
     * @return string
     *
     * Generate of random word for readable email name
     */
    public static function randomWord(): string
    {
        $c = 'bcdfghjklmnprstvwz'; //consonants except hard to speak ones
        $v = 'aeiou';              //vowels
        $a = $c . $v;              //both
        $pw = '';
        for ($j = 0; $j < 2; $j++) {
            $pw .= $c[rand(0, strlen($c) - 1)];
            $pw .= $v[rand(0, strlen($v) - 1)];
            $pw .= $a[rand(0, strlen($a) - 1)];
        }
        return $pw;
    }

    public static function formatBytes($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}
