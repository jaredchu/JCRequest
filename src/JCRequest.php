<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 31/05/2017
 * Time: 09:40
 */

namespace JC;


use GuzzleHttp\Client;

class JCRequest implements iJCRequest
{
    /**
     * @var Client
     */
    public $client;

    /**
     * JCRequest constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    public function get($url, $headers, $params, $options)
    {
        return new JCResponse($this->client->get($url, []));
    }

    public function post($url, $headers, $params, $options)
    {
        // TODO: Implement post() method.
    }

    public function put($url, $headers, $params, $options)
    {
        // TODO: Implement put() method.
    }

    public function patch($url, $headers, $params, $options)
    {
        // TODO: Implement patch() method.
    }

    public function head($url, $headers, $params, $options)
    {
        // TODO: Implement head() method.
    }

    public function delete($url, $headers, $params, $options)
    {
        // TODO: Implement delete() method.
    }
}