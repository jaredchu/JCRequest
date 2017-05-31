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
    public function testGet()
    {
        $url = 'https://httpbin.org/get';

        $response = JCRequest::get($url);
        $this->assertEquals(200, $response->status());
        $this->assertNotEmpty($response->body());
    }

    public function testPost()
    {
        $url = 'https://httpbin.org/post';

        $response = JCRequest::post($url, ['hello' => 'world']);
        $this->assertEquals(200, $response->status());
        $this->assertNotEmpty($response->body());
    }
}