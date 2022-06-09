<?php
namespace Dadapas\Http;

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

	protected $header;

	protected $url;

	public function __construct($url = "")
	{
		$this->curl = curl_init();
		$this->url = $url;
	}

	public function sendRequest(RequestInterface $request): ResponseInterface
	{
		$this->request = $request;

		$response = new Response();

		return $response;
	}

	public function headers(array $headers)
	{
		foreach($headers as $key => $head)
		{
			$this->header[$key] => $head;
		}
	}


	public function baseUri(string $url)
	{
		$this->url = $url;
	}

	protected function setOption($key, $value)
	{
		curl_setopt($this->curl, $key, $value);
	}

	public function get(string $url): ResponseInterface
	{
		$this->setOption( CURLOPT_URL, $url);

		$response = new Response();
		return $response;
	}

	public function post(string $uri, array $data)
	{

	}

	public static function __callStatic($name, $arguments)
    {

    }

	public function __destruct()
	{
		curl_close($this->curl);
	}
}