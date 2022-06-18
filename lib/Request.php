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

	/*protected $sep = ",";*/

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
		//parent::__construct();
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

	/**
	 * Get the header array
	 * 
	 * @return array
	*/
	public function headerArray()
	{
		$headers = [];
		foreach(array_merge($this->headers, $this->header_changed) as $key => $header)
		{
			$headerString = implode($this->sep, $header);
			$headers[] = "{$key}: {$headerString}";
		}

		return $headers;
	}
}