<?php namespace Supared\Sentora\SingleSignOnClient\Entities;

use Supared\Sentora\SingleSignOnClient\Utils\Validator as Validate;

class Token
{

    const URL_STRING_PARAMS = "ssoServInit=%s&ssoToken=%s";

    /**
     * The generated (encrypted) token string.
     * @var string 
     */
    private $token;

    /**
     * The target server's init auth key.
     * @var string
     */
    private $server_init;

    public function __construct($token, $server_init_auth)
    {
        $this->token = $token;
        $this->server_init = $server_init_auth;
    }

    /**
     * Returns the generated SSO token string.
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Returns the Sentora server init string.
     * @return string
     */
    public function getServerInit()
    {
        return $this->server_init;
    }

    /**
     * Returns a formatted URL string containing the target server address;
     * server init auth and token parameters.
     * @param string $target_server The URL for the target server (eg. https://cp.mydomain.com/)
     * @return string
     */
    public function getTokenUrl($target_server)
    {
        Validate::serverTargetAddress($target_server);
        return rtrim($target_server, '/') . "?" . sprintf(self::URL_STRING_PARAMS, $this->getServerInit(), $this->getToken());
    }

    /**
     * Generate a HTML link snippet.
     * @param string $target_server The target server address (eg. https://cp.mydomain.com/)
     * @param string $target_blank Open the Sentora CP session in a new browser window?
     * @param string $attributes Additonal HTML link attirbutes eg. 'class', 'id' etc.
     */
    public function getSsoLink($target_server, $target_blank = true, $attributes = [])
    {
        
    }

    public function __toString()
    {
        return $this->token;
    }
}
