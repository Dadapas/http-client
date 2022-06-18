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

use Psr\Http\Message\ResponseInterface;
use InvalidArgumentException;
use stdClass;

class Response extends Message implements ResponseInterface
{
    protected $status;

    protected $stream;

    protected static $statuses = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        103 => 'Early Hints',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentification Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Too Early',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        451 => 'Unavailable For Legal Reasons',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        510 => 'Not Extended',
        511 => 'Network Authentification Required'
    ];

    protected $sep = "; ";

    protected $content;

    public static function isValidStatus($status)
    {
        if ( ! array_key_exists($status, self::$statuses) )
            throw new InvalidArgumentException('Invalid status code.');
    }

    public function __construct($status = 200, $content = '')
    {
        self::isValidStatus($status);

        $this->status = $status;
        $stream = new Stream();
        
        if ( ! empty($content))
            $stream->write($content);
        
        $this->body = $stream;
    }

	public function getStatusCode()
	{
        return $this->status;
    }

	public function withStatus($code, $reasonPhrase = '')
	{
        self::isValidStatus($code);
        
        $this->status = $code;

        return $this;
    }

	/**
	 * @return string Reason phrase; must return an empty string
	*/
	public function getReasonPhrase()
	{
        return self::$statuses[$this->status] ?: '';
    }

    protected function response(bool $toArray = false)
    {
        $stringBody = $this->content;

        if (null === $this->content)
        {
            $stringBody = (string) $this->body;
        }

        $this->content = $stringBody;
        return json_decode($stringBody, $toArray);
    }

    public function json()
    {
        return $this->response(true);
    }

    public function result()
    {
        return $this->response();
    }

    public function code()
    {
        return $this->getStatusCode();
    }

    public function status()
    {
        return $this->getReasonPhrase();
    }

    public function toString()
    {

        if (null === $this->content)
        {
            $body = (string) $this->body;
            $this->content = $body;
        }

        return $this->content;
    }
}