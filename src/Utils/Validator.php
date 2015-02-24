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
        if (self::isNull($username)) {
            self::raiseValidationException("The username cannot be empty, please set a username!");
        }
        if (!self::hasMoreThanCharaters($username, 1)) {
            self::raiseValidationException("The username must contain more than 1 character!");
        }
    }

    public static function uid($uid)
    {
        if (self::isNull($uid)) {
            self::raiseValidationException("The UID cannot be empty, please set a user ID!");
        }
        if (!self::isInteger($uid)) {
            self::raiseValidationException("The UID must be an integer value type.");
        }
        if (!self::intLargerThan($uid, 0)) {
            self::raiseValidationException("The UID must be greater than zero!");
        }
    }

    public static function validityPeriod($timestamp)
    {
        if (!self::isValidDateFormat($timestamp)) {
            self::raiseValidationException("The validity expirey timestamp must be in this format YYYYMMDDHHMM.");
        }
        if (!self::isDateInFuture($timestamp)) {
            self::raiseValidationException("The validity expirey timestamp cannot be in the past.");
        }
    }

    public static function serverTargetAddress($address)
    {
        if (!self::isValidBaseUrl($address)) {
            self::raiseValidationException("The target server address failed validation and must be formatted like: http://yourdomain.com/ or https://yourdomain.com/");
        }
    }

    private static function raiseValidationException($msg)
    {
        throw new \Supared\Sentora\SingleSignOnClient\Exceptions\ValidationException($msg);
    }

    private static function hasMoreThanCharaters($string, $chars)
    {
        if (strlen($string) > $chars) {
            return true;
        }
        return false;
    }

    private static function isNull($string)
    {
        if (is_null($string) || empty($string)) {
            return true;
        }
        return false;
    }

    private static function intLargerThan($int, $than)
    {
        if ($int > $than) {
            return true;
        }
        return false;
    }

    private static function isInteger($value)
    {
        if (is_int($value)) {
            return true;
        }
        return false;
    }

    private static function isValidBaseUrl($value)
    {
        $regex_rule = "";
        return true;
    }

    private static function isValidDateFormat($date)
    {
        $regex_rule = "";
        return true;
    }

    private static function isDateInFuture($date)
    {
        return true;
    }
}
