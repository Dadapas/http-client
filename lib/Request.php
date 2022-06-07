<?php
namespace Dadapas\Http;

use Psr\Http\Message\RequestInterface;

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