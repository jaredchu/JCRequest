<?php

/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 31/05/2017
 * Time: 10:14
 */

use JC\HttpClient\JCRequest;

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
        $url = $this->baseUrl;
        $response = JCRequest::get($url);
        $this->assertEquals(200, $response->status());

        //test get with params
        $url = $this->baseUrl . '/get?a=1';

        $response = JCRequest::get($url, $this->params, $this->headers);
        $this->assertTrue($response->success());
        $this->assertEquals(200, $response->status());
        $this->assertNotEmpty($response->body());

        $responseData = $response->json();
        $this->assertEquals($this->baseUrl.'/get?a=1&b=2&c=3', $responseData->url);
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

        $responseData = $response->json();
        $this->assertEquals($this->baseUrl.'/post?a=1', $responseData->url);
        $this->assertEquals(1, $responseData->args->a);
        $this->assertEquals(2, $responseData->form->b);
        $this->assertEquals(3, $responseData->form->c);

        $this->assertEquals('Jared Chu', $responseData->headers->{'User-Agent'});
        $this->assertEquals('application/json', $responseData->headers->{'Accept'});
    }

    public function testPut()
    {
        $url = $this->baseUrl . '/put?a=1';

        $response = JCRequest::put($url, $this->params, $this->headers);
        $this->assertEquals(200, $response->status());

        $responseData = $response->json();
        $this->assertEquals($this->baseUrl.'/put?a=1', $responseData->url);
        $this->assertEquals(1, $responseData->args->a);
        $this->assertEquals(2, $responseData->form->b);
        $this->assertEquals(3, $responseData->form->c);

        $this->assertEquals('Jared Chu', $responseData->headers->{'User-Agent'});
        $this->assertEquals('application/json', $responseData->headers->{'Accept'});
    }

    public function testPatch()
    {
        $url = $this->baseUrl . '/patch?a=1';

        $response = JCRequest::patch($url, $this->params, $this->headers);
        $this->assertEquals(200, $response->status());

        $responseData = $response->json();
        $this->assertEquals($this->baseUrl.'/patch?a=1', $responseData->url);
        $this->assertEquals(1, $responseData->args->a);
        $this->assertEquals(2, $responseData->form->b);
        $this->assertEquals(3, $responseData->form->c);

        $this->assertEquals('Jared Chu', $responseData->headers->{'User-Agent'});
        $this->assertEquals('application/json', $responseData->headers->{'Accept'});
    }

    public function testDelete()
    {
        $url = $this->baseUrl . '/delete?a=1';

        $response = JCRequest::delete($url, $this->params, $this->headers);
        $this->assertEquals(200, $response->status());

        $responseData = $response->json();
        $this->assertEquals($this->baseUrl.'/delete?a=1', $responseData->url);
        $this->assertEquals(1, $responseData->args->a);
        $this->assertEquals(2, $responseData->form->b);
        $this->assertEquals(3, $responseData->form->c);

        $this->assertEquals('Jared Chu', $responseData->headers->{'User-Agent'});
        $this->assertEquals('application/json', $responseData->headers->{'Accept'});
    }

    public function testHead()
    {
        $url = $this->baseUrl . '/headers';

        $response = JCRequest::head($url, $this->headers);
        $this->assertEquals(200, $response->status());
        $this->assertEmpty($response->body());
    }

    public function testJson()
    {
        $url = $this->baseUrl . '/post?a=1';

        $response = JCRequest::post($url, json_encode($this->params), $this->headers);
        $this->assertEquals(200, $response->status());

        $responseData = $response->json();
        $this->assertEquals($this->baseUrl.'/post?a=1', $responseData->url);
        $this->assertEquals(1, $responseData->args->a);
        $this->assertEquals('{"b":2,"c":"3"}', $responseData->data);

        $this->assertEquals('Jared Chu', $responseData->headers->{'User-Agent'});
        $this->assertEquals('application/json', $responseData->headers->{'Accept'});
    }

    public function testRequestRaw()
    {
        $url = $this->baseUrl . '/post';
        $data = 'raw body';
        $response = JCRequest::post($url, $data, $this->headers);

        $responseData = $response->json();
        $this->assertEquals($this->baseUrl.'/post', $responseData->url);
        $this->assertEquals($data, $responseData->data);

        $this->assertEquals('Jared Chu', $responseData->headers->{'User-Agent'});
        $this->assertEquals('application/json', $responseData->headers->{'Accept'});
    }

    public function testStatusCode()
    {
        $this->assertEquals(200, JCRequest::get($this->baseUrl . '/status/200')->status());
        $this->assertEquals(300, JCRequest::get($this->baseUrl . '/status/300')->status());
        $this->assertEquals(400, JCRequest::get($this->baseUrl . '/status/400')->status());
        $this->assertEquals(500, JCRequest::get($this->baseUrl . '/status/500')->status());
        $this->assertEquals(503, JCRequest::get($this->baseUrl . '/status/100')->status());
    }

    public function testBasicAuth()
    {
        $userName = 'user';
        $passwd = 'passwd';
        $url = $this->baseUrl . "/basic-auth/$userName/$passwd";

        $response = JCRequest::get($url, [], [], [
            'auth' => [$userName, $passwd]
        ]);

        $this->assertEquals(200, $response->status());
    }

    public function testRequestTimeout()
    {
        $url = $this->baseUrl . '/delay/3';
        $response = JCRequest::get($url, [], [], [
            'connect_timeout' => 2,
            'timeout' => 2
        ]);

        $this->assertFalse($response->success());
        $this->assertFalse($response->status());
        $this->assertNull($response->headers());
        $this->assertNull($response->json());
    }
}
