<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 31/05/2017
 * Time: 09:40
 */

namespace JC;


use GuzzleHttp\Client;
use Purl\Url;

class JCRequest implements iJCRequest
{
    /**
     * @param $url
     * @param array $headers
     * @param array $params
     * @param array $options
     * @return JCResponse
     */
    public static function get($url, $params = [], $headers = [], $options = [])
    {
        $finalUrl = static::manipulateUrl($url, $params);

        $client = new Client();
        return new JCResponse($client->request('GET', $finalUrl, [
            'headers' => $headers
        ]));
    }

    public static function post($url, $params = [], $headers = [], $options = [])
    {
        $client = new Client();
        return new JCResponse($client->request('POST', $url, [
            'headers' => $headers,
            'form_params' => $params
        ]));
    }

    public static function put($url, $params, $headers, $options)
    {
        // TODO: Implement put() method.
    }

    public static function head($url, $params, $headers, $options)
    {
        // TODO: Implement head() method.
    }

    public static function delete($url, $params, $headers, $options)
    {
        // TODO: Implement delete() method.
    }


    /**
     * @param string $url
     * @param array $params
     * @return string
     */
    protected static function manipulateUrl($url, $params = [])
    {
        $urlObject = Url::parse($url);
        $queryData = array_merge($urlObject->query->getData(), $params);
        $urlObject->query->setData($queryData);

        return $urlObject->getUrl();
    }
}