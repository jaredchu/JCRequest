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
    public static function get($url, $headers = [], $params = [], $options = [])
    {
        $client = new Client();
        return new JCResponse($client->get($url));
    }

    public static function post($url, $headers, $params, $options)
    {
        // TODO: Implement post() method.
    }

    public static function put($url, $headers, $params, $options)
    {
        // TODO: Implement put() method.
    }

    public static function patch($url, $headers, $params, $options)
    {
        // TODO: Implement patch() method.
    }

    public static function head($url, $headers, $params, $options)
    {
        // TODO: Implement head() method.
    }

    public static function delete($url, $headers, $params, $options)
    {
        // TODO: Implement delete() method.
    }
}