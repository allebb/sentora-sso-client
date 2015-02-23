<?php namespace Supared\Sentora\SingleSignOnClient\Entities;

use Supared\Sentora\SingleSignOnClient\Utils\Validator as Validate;

/**
 * Sentora SSO Module Client - A PHP SSO Token and passthru generation library.
 * @author Bobby Allen (ballen@bobbyallen.me)
 * @copyright (c) 2015, Supared Limited
 * @link https://github.com/supared/sentora-sso-client
 * @license https://github.com/supared/sentora-sso-client/blob/master/LICENSE
 * @version 1.0.0
 */
class Token
{

    /**
     * The SSO URL string layout.
     */
    const URL_STRING_PARAMS = "ssoToken=%s&ssoInit=%s";

    /**
     * The generated (encrypted) token string.
     * @var string 
     */
    private $token;

    /**
     * The initiation vector to use.
     * @var string
     */
    private $iv;

    public function __construct($token, $iv)
    {
        $this->token = $token;
        $this->iv = $iv;
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
    public function getIv()
    {
        return $this->iv;
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
        return rtrim($target_server, '/') . '/?' . sprintf(self::URL_STRING_PARAMS, $this->getToken(), $this->getIv());
    }

    /**
     * Generate a HTML link snippet.
     * @param string $target_server The target server address (eg. https://cp.mydomain.com/)
     * @param string $target_blank Open the Sentora CP session in a new browser window?
     * @param string $attributes Additonal HTML link attirbutes eg. 'class', 'id' etc.
     */
    public function getSsoLink($target_server, $link_text = 'Login', $target_blank = true, $attributes = [])
    {

        $link_attributes = '';
        if (count($attributes) > 0) {
            $attr_string = '';
            foreach ($attributes as $attribute => $value) {
                $attr_string .= sprintf("%s=\"%s\" ", $attribute, $value);
            }
            $link_attributes = ' ' . trim($attr_string);
        }
        $link_target = '';
        if ($target_blank) {
            $link_target = ' target="_blank"';
        }
        return '<a href="' . $this->getTokenUrl($target_server) . '"' . $link_target . $link_attributes . '>' . $link_text . '</a>';
    }

    /**
     * The standard 'toString()' method, will output the SSO token only (no IV!)
     * @return type
     */
    public function __toString()
    {
        return $this->token;
    }
}
