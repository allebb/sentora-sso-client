<?php namespace Supared\Sentora\SingleSignOnClient\Entities;

class Token
{

    private $token;
    private $server_auth;

    public function __construct($token, $server_auth = null)
    {
        $this->token = $token;
        $this->server_auth = $server_auth;
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
     * Returns the Sentora server init auth string.
     * @return string
     */
    public function getServerAuth()
    {
        return $this->server_auth;
    }

    /**
     * Returns a formatted URL string containing the target server address;
     * server init auth and token parameters.
     * @param string $target_server The URL for the target server (eg. https://cp.mydomain.com/)
     * @return string
     */
    public function getTokenUrl($target_server)
    {
        // Validate it contains the http(s):// apart!
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
