# JCRequest
Another Guzzle wrapper

[![Packagist](https://img.shields.io/packagist/v/jaredchu/jc-request.svg)](https://packagist.org/packages/jaredchu/jc-request)
[![Packagist](https://img.shields.io/packagist/dt/jaredchu/jc-request.svg)](https://packagist.org/packages/jaredchu/jc-request)
[![Travis](https://img.shields.io/travis/jaredchu/JCRequest.svg)](https://travis-ci.org/jaredchu/JCRequest)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/jaredchu/JCRequest.svg)](https://scrutinizer-ci.com/g/jaredchu/JCRequest/)
[![Codecov](https://img.shields.io/codecov/c/github/jaredchu/JCRequest.svg)](https://codecov.io/gh/jaredchu/JCRequest)
[![Packagist](https://img.shields.io/packagist/l/jaredchu/jc-request.svg)](https://packagist.org/packages/jaredchu/jc-request)

## Installation
`$ composer require jaredchu/jc-request`

## Usage

#### GET
```PHP
$response = JCRequest::get($url);
echo $response->status();
echo $response->body();
var_dump($response->json());
```
#### POST
```PHP
$response = JCRequest::post($url, $params, $headers);
echo $response->status();
echo $response->body();
var_dump($response->json());
```
#### RESTful
```PHP
$response = JCRequest::post($url, json_encode($params), $headers);
var_dump($response->json());
```

## Contributing
1. Fork it!
2. Create your feature branch: `$ git checkout -b feature/your-new-feature`
3. Commit your changes: `$ git commit -am 'Add some feature'`
4. Push to the branch: `$ git push origin feature/your-new-feature`
5. Submit a pull request.

## License
[MIT License](https://github.com/jaredchu/JCRequest/blob/master/LICENSE)
