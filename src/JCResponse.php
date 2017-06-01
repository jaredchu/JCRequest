<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 31/05/2017
 * Time: 09:50
 */

namespace JC;


use Psr\Http\Message\ResponseInterface;

class JCResponse implements iJCResponse
{

    /**
     * @var ResponseInterface
     */
    public $response;

    /**
     * @var string
     */
    protected $body;

    /**
     * JCResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $response;
        $this->body = $this->response->getBody()->getContents();
    }


    public function status()
    {
        return $this->response->getStatusCode();
    }

    public function body()
    {
        return $this->body;
    }

    public function headers()
    {
        return $this->response->getHeaders();
    }
}