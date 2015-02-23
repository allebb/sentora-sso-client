<?php namespace Supared\Sentora\SingleSignOnClient;

use Supared\Sentora\SingleSignOnClient\Entities\Token;
use Supared\Sentora\SingleSignOnClient\Utils\Validator;

class Client
{

    private $server_auth;
    private $key;
    private $iv;
    private $valid_till;
    protected $validator;

    public function __construct()
    {
        $this->checkDependencies();
        $this->validator = new Validator;
    }

    /**
     * Set the server auth key.
     * @param string $auth
     * @return \Supared\Sentora\SingleSignOnClient\Client
     */
    public function setServerAuthKey($auth)
    {
        $this->server_auth = $auth;
        return $this;
    }

    /**
     * Set the corresponding encryption key that is also set on the Sentora server.
     * @param string $key
     * @return \Supared\Sentora\SingleSignOnClient\Client
     */
    public function setKey($key)
    {
        return $this;
    }

    /**
     * Set the initiation vector as also set on the Sentora server.
     * @param string $iv
     * @return \Supared\Sentora\SingleSignOnClient\Client
     */
    public function setIv($iv)
    {
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
        return $this;
    }

    /**
     * Set the user ID as it appears in the Sentora Users table.
     * @param int $uid
     * @return \Supared\Sentora\SingleSignOnClient\Client
     */
    public function setUid($uid)
    {
        // Validate that this is an integer!
        return $this;
    }

    /**
     * Set the username as it appears in the Sentora Users table.
     * @param string $username
     * @return \Supared\Sentora\SingleSignOnClient\Client
     */
    public function setUsername($username)
    {
        return $this;
    }

    /**
     * Generate the token and return the Token entity object to enable
     * output as string, URLs and HTML links.
     * @return \Supared\Sentora\SingleSignOnClient\Entities\Token
     */
    public function generate()
    {
        // Generate the SSO token and then we'll pass it to the Token entity..
        return new Token($generated_token, $server_auth);
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
}
