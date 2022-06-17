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

		$response->

		return $response;
	}

	public function headers(array $headers)
	{
		foreach($headers as $key => $head)
		{
			$this->header[$key] = $head;
		}
		return $this;
	}


	public function baseUri(string $url)
	{
		$this->url = $url;
	}

	public function setOption($key, $value)
	{
		curl_setopt($this->curl, $key, $value);
	}

	public function get(string $url)
	{
		$this->setOption( CURLOPT_URL, $url);

		$response = new Response();
		return $response;
	}

	public function post(string $uri, array $data)
	{
		echo "post called";
		$this->url = preg_replace('/\/$/', '', $this->url);
		$uri = preg_replace('/^\//', '', $uri);

		$this->setOption( CURLOPT_URL, $this->url.'/'.$uri );

		$response = new Response();
		return $response;
	}

	public static function __callStatic($name, $arguments)
    {
    	call_user_func_array(array($this, $name), $arguments);
    }

	public function __destruct()
	{
		curl_close($this->curl);
	}
}