<?php
namespace Dadapas\Http;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

class Message implements MessageInterface
{
	protected $header_changed = [];

	protected $sep = ",";

	protected $headers = [
		'accept' => ['*/*'],
		'content-type' => ['text/html', 'charset=UTF-8'],
		'connection' => ['keep-alive'],
	];

	protected $protocol;

	protected $body;

	public function __construct()
	{

	}

	public function withProtocolVersion($version)
	{
		$this->protocol = $version;
	}

	public function getProtocolVersion()
	{
		return $this->protocol;
	}

	public function getHeaders()
	{
		return $this->headers;
	}

	public function getHeader($name)
	{
		if ( ! $this->hasHeader($name))
			return [];
		return $this->header_changed[strtolower($name)];
	}

	public function getChangedHeader()
	{
		return $this->header_changed;
	}

	public function getHeaderLine($name)
	{
		if ( ! isset($this->header_changed[strtolower($name)]))
		{
			$header = $this->headers[strtolower($name)];
			if ( ! $header )
				return '';

			return implode($this->sep, $header);
		}

		$values = $this->header_changed[strtolower($name)];
		return implode($this->sep, array_keys($values));
	}

	public function withHeader($name, $value)
	{
		$this->header_changed[strtolower($name)][$value] = $value;

		return $this;
	}

	public function withAddedHeader($name, $value)
	{
		//if ()
		$this->header_changed[strtolower($name)][$value] = $value;
		return $this;
	}

	public function withoutHeader($name)
	{
		unset($this->headers[strtolower($name)]);
		unset($this->header_changed[strtolower($name)]);
		
		return $this;
	}

	public function hasHeader($name)
	{
		if ( isset($this->headers[strtolower($name)]) )
			return true;
		return false;
	}

	public function getBody()
	{
		return $this->body;
	}

	public function withBody(StreamInterface $body)
	{
		$this->body = $body;

		return $this;
	}
}