<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 31/05/2017
 * Time: 10:23
 */

namespace JC;


interface iJCResponse
{
    public function status();

    public function body();

    public function headers();

    public function json();
}