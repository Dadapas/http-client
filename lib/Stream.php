<?php
namespace Dadapas\Http;

use Psr\Http\Message\StreamInterface;

/**
 * Describes a data stream.
 *
 * Typically, an instance will wrap a PHP stream; this interface provides
 * a wrapper around the most common operations, including serialization of
 * the entire stream to a string.
 */
class Stream implements StreamInterface
{
	/**
     * Reads all data from the stream into a string, from the beginning to end.
     *
     * This method MUST attempt to seek to the beginning of the stream before
     * reading data and read the stream until the end is reached.
     *
     * Warning: This could attempt to load a large amount of data into memory.
     *
     * This method MUST NOT raise an exception in order to conform with PHP's
     * string casting operations.
     *
     * @see http://php.net/manual/en/language.oop5.magic.php#object.tostring
     * @return string
     */
	public function __toString()
	{}

	/**
     * Closes the stream and any underlying resources.
     *
     * @return void
     */
	public function close()
	{}

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
	{}

	/**
     * Returns the current position of the file read/write pointer
     *
     * @return int Position of the file pointer
     * @throws \RuntimeException on error.
     */
	public function tell()
	{

	}

	/**
     * Returns true if the stream is at the end of the stream.
     *
     * @return bool
     */
	public function eof()
	{}

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
     * @see http://www.php.net/manual/en/function.fseek.php
     * @param int $offset Stream offset
     * @param int $whence Specifies how the cursor position will be calculated
     *     based on the seek offset. Valid values are identical to the built-in
     *     PHP $whence values for `fseek()`.  SEEK_SET: Set position equal to
     *     offset bytes SEEK_CUR: Set position to current location plus offset
     *     SEEK_END: Set position to end-of-stream plus offset.
     * @throws \RuntimeException on failure.
     */
	public function seek($offset, $whence = SEEK_SET)
	{}

	public function rewind()
	{}

	public function isWritable()
	{}

	public function write($string)
	{}

	public function isReadable()
	{}

	public function read($length)
	{}

	public function getContents()
	{}

	public function getMetadata($key = null)
	{}
}