<?php namespace Supared\Sentora\SingleSignOnClient;

use Supared\Sentora\SingleSignOnClient\Entities\Token;
use Supared\Sentora\SingleSignOnClient\Utils\Validator as Validate;

class Client
{

    const CRYPTO_CIPHER = MCRYPT_3DES;
    const CRYPTO_MODE = MCRYPT_MODE_CBC;

    /**
     * The target server's auth init key
     * @var string 
     */
    private $server_init;
    
    /**
     * The encryption key as set in the Sentora SSO module.
     * @var string
     */
    private $key;
    
    /**
     * The initiation vector as set in the Sentora SSO module.
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
     * Set the server init key.
     * @param string $auth
     * @return \Supared\Sentora\SingleSignOnClient\Client
     */
    public function setServerInitKey($auth)
    {
        Validate::serverInitAuth($auth);
        $this->server_init = $auth;
        return $this;
    }

    /**
     * Set the corresponding encryption key that is also set on the Sentora server.
     * @param string $key
     * @return \Supared\Sentora\SingleSignOnClient\Client
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Set the initiation vector as also set on the Sentora server.
     * @param string $iv
     * @return \Supared\Sentora\SingleSignOnClient\Client
     */
    public function setIv($iv)
    {
        $this->iv = $iv;
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
     * Generate the token and return the Token entity object to enable
     * output as string, URLs and HTML links.
     * @return \Supared\Sentora\SingleSignOnClient\Entities\Token
     */
    public function generate($uid, $username)
    {
        Validate::username($username);
        Validate::uid($uid);
        // Generate the SSO token and then we'll pass it to the Token entity..
        $token = $this->encryptToken($uid, $username);
        return new Token($token, $this->server_init);
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

    private function encryptToken($uid, $username)
    {
        $build = sprintf("uid=%u&user=%s&validtill=%s", $uid, $username, $this->valid_till);
        $encrypt = mcrypt_encrypt(self::CRYPTO_MODE, $this->key, $data, self::CRYPTO_MODE, $this->iv);
        return bin2hex($encrypt);
    }
}
