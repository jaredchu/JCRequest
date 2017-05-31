<?php

/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 31/05/2017
 * Time: 10:14
 */

use JC\JCRequest;

class JCRequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var JCRequest
     */
    private $request;

    public function setUp()
    {
        $this->request = new JCRequest();
        $this->url = 'http://google.com';
    }

    public function testGet()
    {
        $this->assertEquals(200, $this->request->get($this->url, [], [], [])->status());
    }
}