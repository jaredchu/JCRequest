<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 31/05/2017
 * Time: 10:23
 */

namespace JC;


/**
 * Interface iJCResponse
 * @package JC
 */
interface iJCResponse
{
    /**
     * @return integer
     */
    public function status();

    /**
     * @return string
     */
    public function body();

    /**
     * @return array
     */
    public function headers();

    /**
     * @return object
     */
    public function json();

    /**
     * @return boolean
     */
    public function success();
}