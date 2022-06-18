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

use Psr\Http\Message\StreamInterface;
use RuntimeException;

class Stream implements StreamInterface
{
    protected $metadata;

    protected $resource;

    protected $tmpfile;

    protected $content;

    public function __construct()
    {
        $this->metadata = [];
        $this->tmpfile = tempnam(sys_get_temp_dir(), 'ddp');

        $this->resource = fopen($this->tmpfile, 'a+');
    }

    public function getResource()
    {
        return $this->resource;
    }

	/**
     * Reads all data from the stream into a string, from the beginning to end.
     *
     * @return string
     */
	public function __toString()
	{
        $file = $this->read($this->getSize());

        return $file;
    }

	/**
     * Closes the stream and any underlying resources.
     *
     * @return void
     */
	public function close()
	{
        fclose($this->resource);
    }

	/**
     * Separates any underlying resources from the stream.
     *
     * After the stream has been detached, the stream is in an unusable state.
     *
     * @return resource|null Underlying PHP stream, if any
     */
	public function detach()
	{}

	/**
     * Get the size of the stream if known.
     *
     * @return int|null Returns the size in bytes if known, or null if unknown.
     */
	public function getSize()
	{
        return filesize($this->tmpfile) ?: 1024;
    }

	/**
     * Returns the current position of the file read/write pointer
     *
     * @return int Position of the file pointer
     * @throws \RuntimeException on error.
     */
	public function tell()
	{
        if ( ! $pos = ftell($this->resource) )
            throw new \RuntimeException("Impossible to get file position.");
        return $pos;
	}

	/**
     * Returns true if the stream is at the end of the stream.
     *
     * @return bool
     */
	public function eof()
	{
        return feof($this->resource);
    }

	/**
     * Returns whether or not the stream is seekable.
     *
     * @return bool
     */
	public function isSeekable()
	{}

	/**
     * Seek to a position in the stream.
     *
     * @param int $offset Stream offset
     * @param int $whence Specifies how the cursor position will be calculated
     *     based on the seek offset.
     * @throws \RuntimeException on failure.
     */
	public function seek($offset, $whence = SEEK_SET)
	{
        return fseek($this->resource, $offset, $whence);
    }

	public function rewind()
	{
        rewind($this->getResource());
    }

	public function isWritable()
	{
        return is_writable($this->tmpfile);
    }

	public function write($string)
	{
        $resource = $this->getResource();
        fwrite($resource, $string);
        $this->seek(0);
    }

	public function isReadable()
	{
        return is_readable($this->tmpfile);
    }

	public function read($length)
	{
        $content = fread($this->resource, $length);
        return $content ?: '';
    }

	public function getContents()
	{
        //$this->fseek();
        return $this->read(1024);
    }

	public function getMetadata($key = null)
	{
        if (isset($this->metadata[$key]))
            return $this->metadata[$key];

        return $this->metadata;
    }

    public function __destruct()
    {
        fclose($this->resource);
    }
}