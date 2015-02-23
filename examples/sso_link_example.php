<?php
require_once '../vendor/autoload.php';
use Supared\Sentora\SingleSignOnClient\ClientFactory as SSOClient;

// Specify server encryption and security settings...
$settings = [
    'key' => 'KbAJDGUyNCKBpL8lgzumt5ftpfwKXUW5IcDtETQYMhjcLFef',
    'sentora_base_url' => 'https://cp.mydomain.com',
];

// An example of specifying a matching username and user id from the sentora database.
$user = [
    'id' => 1,
    'name' => 'jbloggs',
];

// Using the Factory class we'll create a new instance of the client...
$sso = SSOClient::create($settings['key']);

// We now generate the token with the given user credentials and request a HTML
// formatted link to our Sentora control panel url:
$ssoLink = $sso->generate($user['id'], $user['name'])->getSsoLink($settings['sentora_base_url'], 'Login now!', false, ['class' => 'btn btn-primary', 'id' => 'sso-link']);

// You can now use the link like so (ideally you'd output this in your view but this is
// just an example, of simply echo'ing our the generated HTML link):
echo "Click the following link to automatically log into Sentora: " . $ssoLink;
