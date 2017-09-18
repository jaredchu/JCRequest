<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 31/05/2017
 * Time: 10:23
 */

namespace JC\HttpClient;


/**
 * Interface iJCResponse
 * @package JC
 */
interface JCResponseInterface
{
    /**
     * @return integer|bool
     */
    public function status();

    /**
     * @return string|null
     */
    public function body();

    /**
     * @return array|null
     */
    public function headers();

    /**
     * @return object|null
     */
    public function json();

    /**
     * @return boolean
     */
    public function success();
}