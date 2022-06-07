<?php
namespace Dadapas\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * Representation of an outgoing, server-side response.
 *
 * Per the HTTP specification, this interface includes properties for
 * each of the following:
 *
 * - Protocol version
 * - Status code and reason phrase
 * - Headers
 * - Message body
 *
 * Responses are considered immutable; all methods that might change state MUST
 * be implemented such that they retain the internal state of the current
 * message and return an instance that contains the changed state.
 */
class Response implements ResponseInterface
{
	public function getStatusCode()
	{}

	public function withStatus($code, $reasonPhrase = '')
	{}

	/**
	 * @return string Reason phrase; must return an empty string
	*/
	public function getReasonPhrase()
	{}
}