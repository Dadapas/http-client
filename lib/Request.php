<?php
namespace Dadapas\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use InvalidArgumentException;

class Request implements RequestInterface
{
	public function getRequestTarget()
	{

	}

	public function withRequestTarget($requestTarget)
	{

	}

	public function getMethod()
	{

	}

	public function withMethod($method)
	{

	}

	public function getUri()
	{}

	public function withUri(UriInterface $uri, $preserverHost = false)
	{
		
	}
}