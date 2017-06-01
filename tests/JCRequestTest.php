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
    private $baseUrl = 'https://httpbin.org';
    private $params;
    private $headers;

    public function setUp()
    {
        $this->params = [
            'b' => 2,
            'c' => '3'
        ];
        $this->headers = [
            'User-Agent' => 'Jared Chu',
            'Accept' => 'application/json'
        ];
    }

    public function testGet()
    {
        $url = $this->baseUrl . '/get?a=1';

        $response = JCRequest::get($url, $this->params, $this->headers);
        $this->assertEquals(200, $response->status());

        $responseData = json_decode($response->body());
        $this->assertEquals('https://httpbin.org/get?a=1&b=2&c=3', $responseData->url);
        $this->assertEquals(1, $responseData->args->a);
        $this->assertEquals(2, $responseData->args->b);
        $this->assertEquals(3, $responseData->args->c);

        $this->assertEquals('Jared Chu', $responseData->headers->{'User-Agent'});
        $this->assertEquals('application/json', $responseData->headers->{'Accept'});
    }

    public function testPost()
    {
        $url = $this->baseUrl . '/post?a=1';

        $response = JCRequest::post($url, $this->params, $this->headers);
        $this->assertEquals(200, $response->status());

        $responseData = json_decode($response->body());
        $this->assertEquals('https://httpbin.org/post?a=1', $responseData->url);
        $this->assertEquals(1, $responseData->args->a);
        $this->assertEquals(2, $responseData->form->b);
        $this->assertEquals(3, $responseData->form->c);

        $this->assertEquals('Jared Chu', $responseData->headers->{'User-Agent'});
        $this->assertEquals('application/json', $responseData->headers->{'Accept'});
    }
}