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
    public function get($url, $headers, $params, $options);

    public function post($url, $headers, $params, $options);

    public function put($url, $headers, $params, $options);

    public function patch($url, $headers, $params, $options);

    public function head($url, $headers, $params, $options);

    public function delete($url, $headers, $params, $options);
}