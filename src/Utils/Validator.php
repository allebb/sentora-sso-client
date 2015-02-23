<?php namespace Supared\Sentora\SingleSignOnClient\Utils;

/**
 * Sentora SSO Module Client - A PHP SSO Token and passthru generation library.
 * @author Bobby Allen (ballen@bobbyallen.me)
 * @copyright (c) 2015, Supared Limited
 * @link https://github.com/supared/sentora-sso-client
 * @license https://github.com/supared/sentora-sso-client/blob/master/LICENSE
 * @version 1.0.0
 */
class Validator
{

    public static function username($username)
    {
        // Validate Uername
        // - Is not null
    }

    public static function uid($uid)
    {
        // Validate User ID is an integer
        // - Is not null
        // - Is an integer
        // - Is greater than zero!
    }

    public static function validityPeriod($timestamp)
    {
        // Validate timestamp
        // - Is valid format YYYYMMDDHHMM
        // - Is in the future
    }

    public static function serverTargetAddress($address)
    {
        // Validate URL string
        // - contains http(s)://
    }
}
