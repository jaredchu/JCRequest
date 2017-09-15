<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 31/05/2017
 * Time: 09:42
 */

namespace JC;


/**
 * Interface iJCRequest
 * @package JC
 */
interface JCRequestInterface
{
    /**
     * @var string $url
     * @var array|string $params
     * @var array $headers
     * @var array $options
     * @return JCResponseInterface
     */
    public static function get($url, $params, $headers, $options);

    /**
     * @var string $url
     * @var array|string $params
     * @var array $headers
     * @var array $options
     * @return JCResponseInterface
     */
    public static function post($url, $params, $headers, $options);

    /**
     * @var string $url
     * @var array|string $params
     * @var array $headers
     * @var array $options
     * @return JCResponseInterface
     */
    public static function put($url, $params, $headers, $options);

    /**
     * @var string $url
     * @var array|string $params
     * @var array $headers
     * @var array $options
     * @return JCResponseInterface
     */
    public static function patch($url, $params, $headers, $options);

    /**
     * @var string $url
     * @var array $headers
     * @var array $options
     * @return JCResponseInterface
     */
    public static function head($url, $headers, $options);

    /**
     * @var string $url
     * @var array|string $params
     * @var array $headers
     * @var array $options
     * @return JCResponseInterface
     */
    public static function delete($url, $params, $headers, $options);

    /**
     * @var string $method
     * @var string $url
     * @var array $guzzleOptions
     * @return JCResponseInterface
     */
    public static function request($method, $url, $guzzleOptions);
}