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

use Psr\Http\Message\ServerRequestInterface;

class ServerRequest implements ServerRequestInterface
{
	public function getServerParams()
	{}

	public function getCookieParams()
	{}

	public function withCookieParams(array $cookies)
	{}

	public function getQueryParams()
	{}

	public function withQueryParams(array $query)
	{}

	public function getUploadedFiles()
	{}

	public function withUploadedFiles(array $uploadedFiles)
	{}

	public function getParsedBody()
	{}

	/**
	 * @param null|array|object $data The deserialized body data
	 * @return static
	 * @throws \InvalidArgumentException
	*/ 
	public function withParsedBody($data)
	{}

	/**
	 * @return mixed[] Attributes derived from the request.
	 */ 
	public function getAttributes()
	{}

	/**
	 * @see getAttributes()
	 * @param string $name The attribute name.
	 * @param mixed $default Default value 
	*/
	public function getAttribute($name, $default = null)
	{}

	/**
	 * @see getAttributes
	 * @param string $name The attribute name.
	 * @param mixed $value The value of the attribute.
	 * @return static
	*/
	public function withAttribute($name, $value)
	{}

	/**
	 * @see getAttributes()
	 * @param string $name The attribute name.
	 * @return static
	 */
	public function withoutAttribute($name)
	{} 
}