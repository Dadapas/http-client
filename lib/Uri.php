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

use function parse_url;
use Psr\Http\Message\UriInterface;
use InvalidArgumentException;

class Uri implements UriInterface
{
	protected $scheme;

	protected $host;

	protected $user;

	protected $password;

	protected $port;

	protected $path;

	protected $query;

	protected $fragment;

	/**
	 * @throws InvalidArgumentException
	*/ 
	public function __construct(string $uri)
	{
		$parsed = parse_url($uri);

		if ( ! (isset($parsed['scheme']) || isset($parsed['host'])) )
			throw new InvalidArgumentException("invalid uri.");
		
		self::verifySupportSchme($parsed['scheme']);

		$this->scheme = $parsed['scheme'];
		$this->host = $parsed['host'];

		if (isset($parsed['user']))
			$this->user = $parsed['user'];
		if (isset($parsed['pass']))
			$this->password = $parsed['pass'];
		if (isset($parsed['path']))
			$this->path = $parsed['path'];
		if (isset($parsed['query']))
			$this->query = $parsed['query'];
		if (isset($parsed['fragment']))
			$this->fragment = $parsed['fragment'];
	}

	protected static function verifySupportSchme($scheme)
	{
		if ( ! in_array($scheme, ['http', 'https']) )
			throw new InvalidArgumentException('Only "http" and "https" support scheme');
	}

	public function getScheme()
	{
		return $this->scheme;
	}

	public function getAuthority()
	{
		$authority = "";
		if ($userInfo = $this->getUserInfo())
			$authority .= $this->getUserInfo()."@";

		if ($this->host)
			$authority .= "{$this->host}";

		return $authority;
	}

	public function getUserInfo()
	{
		$userInfo = "";
		if ($this->user)
			$userInfo .= "{$this->user}";

		if ($this->user && $this->password)
			$userInfo .= ":{$this->password}";

		return $userInfo;
	}

	public function getHost()
	{
		return $this->host;
	}

	public function getPort()
	{
		return $this->port;
	}

	public function getPath()
	{
		return $this->path;
	}

	public function getQuery()
	{
		return $this->query;
	}

	public function getFragment()
	{
		return $this->fragment;
	}

	public function withScheme($scheme)
	{
		self::verifySupportSchme($scheme);
		$this->scheme = $scheme;
	}

	public function withUserInfo($user, $password = null)
	{
		$this->user = $user;
		$this->password = $password;
	}

	public function withHost($host)
	{
		$this->host = $host;
	}

	public function withPort($port)
	{
		$this->port = $port;
	}

	public function withPath($path)
	{
		$path = preg_replace('/^\/(.+)\/$/', '$1', $path);
		$this->path = "/{$path}";
	}

	public function withQuery($query)
	{
		$query = preg_replace('/\?/', '', $query);
		$this->query = $query;
	}

	public function withFragment($fragment)
	{
		$this->fragment = $fragment;
	}

	public function __toString()
	{
		$uri  = "{$this->scheme}://";

		$uri .= $this->getAuthority();

		$uri .= $this->getPort() ?: '';

		if ($this->path)
			$uri .= $this->path;
		
		if ($this->query)
			$uri .= "?$this->query";

		if ($this->fragment)
			$uri .= "#{$this->fragment}";

		// "{$scheme}://{$authority}/{$path}?{$query}#{$fragment}";
		return $uri;
	}

	public static function valid(string $url)
	{
		return 1 === preg_match('/(http?s?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/', $url);
	}

	public static function combine(string $baseUrl, string $uri)
	{
		$baseUrl = preg_replace('/\/$/', '', $baseUrl);
		
		if ('/' === $uri)
			return $baseUrl;

		$uri = preg_replace('/^\/(.+)(?\/)/', '', $uri);
		return $baseUrl . "/" . $uri;
	}
}