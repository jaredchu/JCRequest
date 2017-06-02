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
        if (isset($options['params'])) {
            $params = $options['params'];
            unset($options['params']);

            if (is_array($params)) {
                $options['form_params'] = $params;
            }
            if (is_string($params)) {
                $options['json'] = json_decode($params);
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
    public static function get($url, $params = null, $headers = [], $options = [])
    {
        return static::request(Method::GET, is_array($params) ? static::manipulateUrl($url, $params) : $url, [
            'headers' => $headers
        ]);
    }

    public static function post($url, $params = null, $headers = [], $options = [])
    {
        return static::request(Method::POST, $url, [
            'headers' => $headers,
            'params' => $params
        ]);
    }

    public static function put($url, $params = null, $headers = [], $options = [])
    {
        return static::request(Method::PUT, $url, [
            'headers' => $headers,
            'params' => $params
        ]);
    }

    public static function patch($url, $params = null, $headers = [], $options = [])
    {
        return static::request(Method::PATCH, $url, [
            'headers' => $headers,
            'params' => $params
        ]);
    }

    public static function delete($url, $params = null, $headers = [], $options = [])
    {
        return static::request(Method::DELETE, $url, [
            'headers' => $headers,
            'params' => $params
        ]);
    }

    public static function head($url, $params = null, $headers = [], $options = [])
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