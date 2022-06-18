## HTTP Client

This is a implementation of psr-18 of php-fig

Basic usage
===========

To get a simple request

```php
use Dadapas\Http\Client as HttpClient;
use Dadapas\Http\Request;
use Dadapas\Http\Exception\HttpException;

try {
	$client = new HttpClient;

	// Make a get request to google
	$request = new Request('GET', "https://www.google.com")
		->withHeader('Content-Type', 'text/html');

	// Return the response to the $response variable
	$response = $client->sendRequest($request);

} catch (HttpException $e) {

	echo $e->getMessage();
}

```
Method of response class are

```php
$response->status();   // Ok
$response->code() ;    // 200
$response->json();     // Return an array of application empty array instead
$response->toString(); // to get the response to string
```

You can then pick one of the implementations of the interface to get a logger.

If you want to implement the interface, you can require this package and
implement `Psr\Http\Message\RequestInterface`, `Psr\Http\Message\ResponseInterface`, `Psr\Http\Message\StreamInterface`, `Psr\Http\Message\UriInterface` and  in your code. Please read the
[PSR-7 http messages](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-7-http-message.md) and [PSR-18 http client](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-18-http-client.md)
for details.

Test
=====

For making a test just

```bash
composer test
```
License
=======

The licence is MIT for more details click [here](LICENCE)