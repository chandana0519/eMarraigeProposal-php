<?php

namespace App\Helpers;
use Crypt;

class Common {

    public static function IsNullOrEmptyString($value) {
        return (!isset($value) || trim($value) =='');
    }

    public static function ConcatDispay($value) {
        return rtrim(trim($value), ",");
    }

    public static function getEncrypt($value) {
        return Crypt::encrypt($value);
    }

    public static function getDecrypt($value) {
        return Crypt::decrypt($value);
    }

}