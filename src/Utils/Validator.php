<?php namespace Supared\Sentora\SingleSignOnClient\Utils;

class Validator
{

    public static function serverInitAuth($key)
    {
        // Validate server auth key
        // - Is not null
    }

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
