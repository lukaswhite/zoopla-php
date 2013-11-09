<?php namespace Lukaswhite\Zoopla;

use Guzzle\Common\Collection;
use Guzzle\Plugin\Oauth\OauthPlugin;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

/**
 * Zoopla API client, based on Guzzle.
 */
class ZooplaClient extends Client
{
    public static function factory($config = array())
    {
        // Provide a hash of default client configuration options
        $default = array('base_url' => 'http://api.zoopla.co.uk/api/v1/');

        // The following values are required when creating the client
        $required = array(
            'base_url',
            'api_key',            
        );

        // Merge in default settings and validate the config
        $config = Collection::fromConfig($config, $default, $required);

        // Create a new Zoopla client
        $client = new self($config->get('base_url'), $config);

        // Always append the API key to each request
        $client->setDefaultOption('query',  array('api_key' => $config['api_key']));

        // Set the Service Description using the supplied JSON config file
        $client->setDescription(ServiceDescription::factory(__DIR__.'/../../../service.json'));

        return $client;
    }
}