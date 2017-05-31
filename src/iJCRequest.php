<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 31/05/2017
 * Time: 09:42
 */

namespace JC;


interface iJCRequest
{
    public static function get($url, $params, $headers, $options);

    public static function post($url, $params, $headers, $options);

    public static function put($url, $params, $headers, $options);

    public static function head($url, $params, $headers, $options);

    public static function delete($url, $params, $headers, $options);
}