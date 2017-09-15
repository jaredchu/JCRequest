<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 31/05/2017
 * Time: 09:50
 */

namespace JC;


use GuzzleHttp;
use Psr\Http\Message\ResponseInterface;

class JCResponse implements JCResponseInterface
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
        if ($response) {
            $this->response = $response;
            $this->body = $this->response->getBody()->getContents();
        }
    }

    public function status()
    {
        if ($this->hasResponse()) {
            return $this->response->getStatusCode();
        } else {
            return false;
        }
    }

    public function body()
    {
        return $this->body;
    }

    public function headers()
    {
        if ($this->hasResponse()) {
            return $this->response->getHeaders();
        } else {
            return null;
        }
    }

    public function json()
    {
        if ($this->hasResponse()) {
            return GuzzleHttp\json_decode($this->body());
        } else {
            return null;
        }
    }

    public function success()
    {
        if ($this->hasResponse()) {
            return $this->response->getStatusCode() < 300;
        } else {
            return false;
        }
    }

    protected function hasResponse()
    {
        return !is_null($this->response);
    }
}