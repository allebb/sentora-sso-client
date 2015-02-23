<?php namespace Supared\Sentora\SingleSignOnClient\Utils;

/**
 * Sentora SSO Module Client - A PHP SSO Token and passthru generation library.
 * @author Bobby Allen (ballen@bobbyallen.me)
 * @copyright (c) 2015, Supared Limited
 * @link https://github.com/supared/sentora-sso-client
 * @license https://github.com/supared/sentora-sso-client/blob/master/LICENSE
 * @version 1.0.0
 */
class IvGenerator
{

    /**
     * The pool of available characters that can be used in the random IV.
     * @var string 
     */
    private static $pool = '0123456789abcdefghijklmnopqrstuvwyxzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * Generates a 16-bit initiation vector string.
     * @return string
     */
    public static function make()
    {
        $pool_length = strlen(self::$pool);
        $iv_length = 16;
        $iv = '';
        for ($i = 0; $i < $iv_length; $i++) {
            $iv .= self::$pool[rand(0, $pool_length - 1)];
        }
        return $iv;
    }
}
