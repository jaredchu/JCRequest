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
    public function get();

    public function post();

    public function put();

    public function patch();

    public function head();

    public function delete();
}