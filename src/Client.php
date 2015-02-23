<?php namespace Supared\Sentora\SingleSignOnClient;

use Supared\Sentora\SingleSignOnClient\Entities\Token;
use Supared\Sentora\SingleSignOnClient\Utils\Validator as Validate;
use Supared\Sentora\SingleSignOnClient\Utils\IvGenerator;

/**
 * Sentora SSO Module Client - A PHP SSO Token and passthru generation library.
 * @author Bobby Allen (ballen@bobbyallen.me)
 * @copyright (c) 2015, Supared Limited
 * @link https://github.com/supared/sentora-sso-client
 * @license https://github.com/supared/sentora-sso-client/blob/master/LICENSE
 * @version 1.0.0
 */
class Client
{

    /**
     * The encryption key as set in the Sentora SSO module.
     * @var string
     */
    private $key;

    /**
     * Used to store the generated IV for each SSO token request.
     * @var string
     */
    private $iv;

    /**
     * A timestamp value specify until which date this token can authenticate and
     * provide SSO authentication till (format YYYYMMDDHHMM)
     * @var int
     */
    private $valid_till;

    public function __construct()
    {
        $this->checkDependencies();
    }

    /**
     * Set the corresponding encryption key that is also set on the Sentora server.
     * @param string $key
     * @return \Supared\Sentora\SingleSignOnClient\Client
     */
    public function setKey($key)
    {
        $this->key = static::hexToAscii($key);
        return $this;
    }

    /**
     * Set the timestamp for the maximum length of time this SSO token will be
     * valid for.
     * @param string $timestamp
     * @return \Supared\Sentora\SingleSignOnClient\Client
     */
    public function setValidTill($timestamp)
    {
        Validate::validityPeriod($timestamp);
        $this->valid_till = $timestamp;
        return $this;
    }

    /**
     * Return the generated IV.
     * @return string
     */
    public function getIv()
    {
        return $this->iv;
    }

    /**
     * Generate the token and return the Token entity object to enable
     * output as string, URLs and HTML links.
     * @return \Supared\Sentora\SingleSignOnClient\Entities\Token
     */
    public function generate($uid, $username)
    {
        Validate::username($username);
        Validate::uid($uid);
        $this->generateIv();
        $token = $this->encryptToken($uid, $username);
        return new Token($token, $this->getIv());
    }

    /**
     * Check that the library dependencies are installed.
     * @throws \RuntimeException
     * @return void
     */
    private function checkDependencies()
    {
        if (!function_exists('mcrypt_encrypt')) {
            throw new \RuntimeException('The PHP mcrypt extention is required but not installed!');
        }
    }

    /**
     * Constructs and encrypts the data to a 3DES encrypted string.
     * @param int $uid
     * @param string $username
     * @return string
     */
    private function encryptToken($uid, $username)
    {
        $build = sprintf("uid=%u&user=%s&validtill=%s", $uid, $username, $this->valid_till);
        $encrypt = mcrypt_encrypt(MCRYPT_3DES, $this->key, $build, MCRYPT_MODE_CBC, static::hexToAscii($this->getIv()));
        return bin2hex($encrypt);
    }

    /**
     * Converts Hexidecimal strings to ASCII.
     * @return string
     */
    private static function hexToAscii($hex)
    {
        $ascii = "";
        $clean_hex = str_replace(' ', '', $hex);
        for ($i = 0; $i < strlen($clean_hex); $i = $i + 2) {
            $ascii .= chr(hexdec(substr($clean_hex, $i, 2)));
        }
        return $ascii;
    }

    /**
     * Generates and sets an initiation vector (IV) for the client.
     * @return void
     */
    private function generateIv()
    {
        $this->iv = IvGenerator::make();
    }
}
