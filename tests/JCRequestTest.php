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

    public function setUp()
    {
        $this->url = 'http://google.com';
    }

    public function testGet()
    {
        $response = JCRequest::get($this->url);
        $this->assertEquals(200, $response->status());
        $this->assertNotEmpty($response->body());
    }
}