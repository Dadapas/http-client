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

use Psr\Http\Message\UploadedFileInterface;

class UploadedFile implements UploadedFileInterface
{
	public function getStream()
	{}

	public function moveTo($targetPath)
	{}

	public function getSize()
	{}

	public function getError()
	{}

	public function getClientFilename()
	{}

	public function getClientMediaType()
	{}
}