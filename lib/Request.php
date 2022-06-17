<?php
namespace Dadapas\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\StreamInterface;
use InvalidArgumentException;

class Request extends Message implements RequestInterface
{

	protected static $methodes = [
		'GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE'
	];

	protected $method;
	
	/**
	 * @property $uri
	*/ 
	protected $uri;
	
	/** @var target request **/
	protected $target;

	protected $sep = "; ";

	/**
	 * @throws InvalidArgumentException
	 * @return void
	*/ 
	protected static function verifyMethod(string $method)
	{
		if ( ! in_array(strtoupper($method), self::$methodes) )
			throw new InvalidArgumentException('Invalid method '. $method);
	}

	public function __construct(string $method, $uri)
	{
		parent::__construct();
		self::verifyMethod($method);

		$this->method = $method;
		$this->uri = new Uri($uri);
	}

	public function getRequestTarget()
	{
		return $this->target;
	}

	public function withRequestTarget($requestTarget)
	{
		$this->target = $requestTarget;

		return $this;
	}

	public function setAuth($user, $pass = null)
	{
		$this->uri->withUserInfo($user, $pass);

		return $this;
	}

	public function getMethod()
	{
		return $this->method;
	}

	public function withMethod($method)
	{
		$this->verifyMethod($method);
		$this->method = $method;

		return $this;
	}

	public function getUri()
	{
		return $this->uri;
	}

	public function withUri(UriInterface $uri, $preserverHost = false)
	{
		$this->uri = $uri;

		return $this;
	}
}