<?php
namespace Dadapas\Http;

class Uri implements UriInterface
{
	public function getScheme()
	{}

	/**
     * Retrieve the authority component of the URI.
     *
     * If no authority information is present, this method MUST return an empty
     * string.
     *
     * The authority syntax of the URI is:
     *
     * <pre>
     * [user-info@]host[:port]
     * </pre>
     *
     * If the port component is not set or is the standard port for the current
     * scheme, it SHOULD NOT be included.
     *
     * @see https://tools.ietf.org/html/rfc3986#section-3.2
     * @return string The URI authority, in "[user-info@]host[:port]" format.
     */
	public function getAuthority()
	{}

	/**
     * Retrieve the user information component of the URI.
     *
     * If no user information is present, this method MUST return an empty
     * string.
     *
     * If a user is present in the URI, this will return that value;
     * additionally, if the password is also present, it will be appended to the
     * user value, with a colon (":") separating the values.
     *
     * The trailing "@" character is not part of the user information and MUST
     * NOT be added.
     *
     * @return string The URI user information, in "username[:password]" format.
     */
	public function getUserInfo()
	{}

	public function getHost()
	{}

	public function getPort()
	{}

	public function getPath()
	{}

	public function getQuery()
	{}

	public function getFragment()
	{}

	public function withScheme($scheme)
	{}

	public function withUserInfo($user, $password = null)
	{}

	public function withHost($host)
	{}

	public function withPort($port)
	{}

	public function withPath($path)
	{}

	public function withQuery($query)
	{}

	public function withFragment($fragment)
	{}

	public function __toString()
	{}
}