<?php namespace Supared\Sentora\SingleSignOnClient;

use Supared\Sentora\SingleSignOnClient\Client;

/**
 * Sentora SSO Module Client - A PHP SSO Token and passthru generation library.
 * @author Bobby Allen (ballen@bobbyallen.me)
 * @copyright (c) 2015, Supared Limited
 * @link https://github.com/supared/sentora-sso-client
 * @license https://github.com/supared/sentora-sso-client/blob/master/LICENSE
 * @version 1.0.0
 */
class ClientFactory
{

    /**
     * Creates a new instance of the SSO client
     * @param string $key The encryption key as set on the Sentora server.
     * @param string $iv The IV (Initiation vector) as set on the Sentora server.
     * @param string $server_init The server initiation key as set on the Sentora server.
     * @return \Supared\Sentora\SingleSignOnClient\Client
     */
    public static function create($key)
    {
        $sso = new Client();
        $sso->setKey($key);
        return $sso;
    }
}
