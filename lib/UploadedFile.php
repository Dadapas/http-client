<?php
namespace Dadapas\Http;

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