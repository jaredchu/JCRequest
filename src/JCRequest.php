<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 31/05/2017
 * Time: 09:40
 */

namespace JC\HttpClient;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use JC\HttpClient\Enums\Method;
use Purl\Url;

class JCRequest implements JCRequestInterface
{
    public static function request($method, $url, $guzzleOptions)
    {
        try {
            return new JCResponse((new Client())->request($method, $url, static::combineParams($guzzleOptions)));
        } catch (RequestException $exception) {
            return new JCResponse($exception->getResponse());
        }
    }

    public static function get($url, $params = null, $headers = [], $options = [])
    {
        return static::request(Method::GET, is_array($params) ? static::combineUrl($url, $params) : $url,
            array_merge(['headers' => $headers], $options));
    }

    public static function post($url, $params = null, $headers = [], $options = [])
    {
        return static::request(Method::POST, $url,
            array_merge(['headers' => $headers, 'params' => $params], $options));
    }

    public static function put($url, $params = null, $headers = [], $options = [])
    {
        return static::request(Method::PUT, $url,
            array_merge(['headers' => $headers, 'params' => $params], $options));
    }

    public static function patch($url, $params = null, $headers = [], $options = [])
    {
        return static::request(Method::PATCH, $url,
            array_merge(['headers' => $headers, 'params' => $params], $options));
    }

    public static function delete($url, $params = null, $headers = [], $options = [])
    {
        return static::request(Method::DELETE, $url,
            array_merge(['headers' => $headers, 'params' => $params], $options));
    }

    public static function head($url, $headers = [], $options = [])
    {
        return static::request(Method::HEAD, $url,
            array_merge(['headers' => $headers], $options));
    }

    /**
     * Manipulate the url & params for GET request
     *
     * @param string $url
     * @param array $params
     * @return string
     */
    protected static function combineUrl($url, $params = [])
    {
        $urlObject = Url::parse($url);
        $queryData = array_merge($urlObject->query->getData(), $params);
        $urlObject->query->setData($queryData);

        return $urlObject->getUrl();
    }

    /**
     * @param array $guzzleOptions
     * @return array
     */
    protected static function combineParams($guzzleOptions)
    {
        if (isset($guzzleOptions['params'])) {
            $params = $guzzleOptions['params'];
            unset($guzzleOptions['params']);

            if (is_array($params)) {
                $guzzleOptions['form_params'] = $params;
            } elseif (is_string($params) && $jsonObject = static::jsonDecode($params)) {
                $guzzleOptions['json'] = $jsonObject;
            } else {
                $guzzleOptions['body'] = $params;
            }
        }

        return $guzzleOptions;
    }

    /**
     * @param $string
     * @return bool|mixed
     */
    private static function jsonDecode($string)
    {
        $jsonObject = json_decode($string);
        if (json_last_error() == JSON_ERROR_NONE) {
            return $jsonObject;
        } else {
            return false;
        }
    }
}