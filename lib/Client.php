<?php
namespace Dadapas\Http;

/**
 * This file is part of the dadapas/http-client library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) TOVOHERY Z. Pascal <tovoherypascal@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

use function curl_setopt;
use function curl_init;
use function curl_close;
use function curl_exec;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client implements ClientInterface
{
	protected $curl;

	protected $request;

	protected $baseUrl;

	protected $header = [];

	public function __construct(string $baseUrl = "")
	{
		$this->curl = curl_init();
		$this->baseUrl = $baseUrl;
	}

	public function sendRequest(RequestInterface $request): ResponseInterface
	{

		$this->setOption(CURLOPT_URL, (string) $request->getUri());
		$this->setOption(CURLOPT_RETURNTRANSFER, true);

		$requestBody = (string) $request->getBody();

		if ('GET' === $request->getMethod())
		{}

		if ( 'POST' === $request->getMethod() )
		{
			$this->setOption(CURLOPT_POST, true);
		}

		if ( 'PUT' === $request->getMethod())
		{
			$this->setOption(CURLOPT_PUT, true);
		}

		// Set headers
		$headers = $request->headerArray();

		$this->setOption( CURLOPT_HTTPHEADER, $headers);

		if ( ! empty($requestBody) )
		{
			$this->setOption(CURLOPT_POSTFIELDS, $requestBody);
		}

		$returnString = curl_exec($this->curl);

		if (curl_errno($this->curl))
		{
			throw new Exception\HttpException(curl_error($this->curl));
		}

		$headers = curl_getinfo($this->curl);

		$response = new Response($headers['http_code'], $returnString);
		$response->withHeader('Content-Type', $headers['content_type']);

		curl_reset($this->curl);

		$this->close();

		return $response;
	}

	protected function applyHeader(RequestInterface $request)
	{
		foreach($this->header as $key => $head) {

			$request->withHeader($key, $head);
		}
	}

	protected function setOption($key, $value)
	{
		curl_setopt($this->curl, $key, $value);
	}

	public function get(string $url)
	{
		if (Uri::valid($this->baseUrl))
		{
			$url = Uri::combine($this->baseUrl, $url);
		}
		
		$request = new Request('GET', $url);
		$this->applyHeader($request);

		return $this->sendRequest($request);
	}

	public function post(string $url, array $data)
	{
		$request = new Request('POST', $uri);
		$this->applyHeader($request);

		return $this->sendRequest($request);
	}

	public function basicAuth(string $user, string $pass)
	{
		$this->header['Authorization'] = 'Basic '. base64_encode("{$user}:{$pass}");

		return $this;
	}

	public function headers(array $headers)
	{
		foreach($headers as $key => $head)
		{
			$this->header[$key] = $head;
		}
		return $this;
	}

    protected function close()
    {
    	curl_close($this->curl);
    }
}
