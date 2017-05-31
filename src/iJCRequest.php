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
    public static function get($url, $headers, $params, $options);

    public static function post($url, $headers, $params, $options);

    public static function put($url, $headers, $params, $options);

    public static function head($url, $headers, $params, $options);

    public static function delete($url, $headers, $params, $options);
}