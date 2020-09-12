<?php

namespace App\Http\Controllers;

/**
 * Author; Emmanuel Paul
 */
class Generator {

    public static function generateSecureRef(Int $number,  $type = 'alnum')
    {
        $mt_rand = mt_rand(10000,99999);
        return self::getHashedToken($number, $type).$mt_rand;
    }


    private static function getPool($type)
    {
        switch ($type) {
            case 'alnum':
                $pool = '0123456789opqrstuvwxyzABCDEFGHJK';
                break;
            case 'alpha':
                $pool = 'abcxyzABCDEFG';
                break;
            case 'hexdec':
                $pool = '012def';
                break;
            case 'numeric':
                $pool = '0189';
                break;
            case 'nozero':
                $pool = '1293546873753';
                break;
            case 'distinct':
                $pool = '2345UVWXYZ';
                break;
            default:
                $pool = (string) $type;
                break;
        }

        return $pool;
    }

    /**
     * Generate a random secure crypt figure
     * @param  integer $min
     * @param  integer $max
     * @return integer
     */
    public static function secureCrypt($min, $max)
    {
        $range = $max - $min;

        if ($range < 0) {
            return $min; // not so random...
        }

        $log    = log($range, 2);
        $bytes  = (int) ($log / 8) + 1; // length in bytes
        $bits   = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);

        return $min + $rnd;
    }

    /**
     * Finally, generate a hashed token
     * @param  integer $length
     * @return string
     */

    public static function getHashedToken($length = 10, $poolType)
    {
        $token = "";
        $max   = strlen(static::getPool($poolType));
        for ($i = 0; $i < $length; $i++) {
            $token .= static::getPool($poolType)[static::secureCrypt(0, $max)];
        }

        return $token;
    }

    public static function passkey($format = 'u', $utimestamp = null)
    {
        if (is_null($utimestamp)) {
            $utimestamp = microtime(true);
        }

        $timestamp = floor($utimestamp);
        $milliseconds = round(($utimestamp - $timestamp) * 1000000);

        return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
    }
}