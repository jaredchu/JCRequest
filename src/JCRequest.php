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
use JC\Enums\Method;

class JCRequest implements iJCRequest
{
    public static function request($method, $url, $options)
    {
        if (isset($options['headers']['Content-Type']) &&
            strpos($options['headers']['Content-Type'], 'application/json') !== false
        ) {
            if (isset($options['form_params'])) {
                $options['json'] = $options['form_params'];
                unset($options['form_params']);
            }
        }

        return new JCResponse((new Client())->request($method, $url, $options));
    }

    /**
     * @param $url
     * @param array $headers
     * @param array $params
     * @param array $options
     * @return JCResponse
     */
    public static function get($url, $params = [], $headers = [], $options = [])
    {
        return static::request(Method::GET, static::manipulateUrl($url, $params), [
            'headers' => $headers
        ]);
    }

    public static function post($url, $params = [], $headers = [], $options = [])
    {
        return static::request(Method::POST, $url, [
            'headers' => $headers,
            'form_params' => $params
        ]);
    }

    public static function put($url, $params = [], $headers = [], $options = [])
    {
        return static::request(Method::PUT, $url, [
            'headers' => $headers,
            'form_params' => $params
        ]);
    }

    public static function patch($url, $params = [], $headers = [], $options = [])
    {
        return static::request(Method::PATCH, $url, [
            'headers' => $headers,
            'form_params' => $params
        ]);
    }

    public static function delete($url, $params = [], $headers = [], $options = [])
    {
        return static::request(Method::DELETE, $url, [
            'headers' => $headers,
            'form_params' => $params
        ]);
    }

    public static function head($url, $params = [], $headers = [], $options = [])
    {
        return static::request(Method::HEAD, $url, [
            'headers' => $headers,
        ]);
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