<?php
namespace App\Utility;

class Base64Url {

    public static function encode($value) {
        $base64 = base64_encode($value);
        if ($base64 === false) {
            return false;
        }

        return str_replace(['+','/','='], ['-','_',''], $base64);
    }

    public static function decode($value) {
        return base64_decode(str_replace(['-','_'], ['+','/'], $value));
    }
}
