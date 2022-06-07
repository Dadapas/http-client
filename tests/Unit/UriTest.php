<?php
namespace Dadapas\HttpTests\Unit;

class UriTest
{
	public function makeOptionTest()
	{
		$request = $request
				->withMethod('OPTIONS')
				->withRequestTarget('*')
				->withUri(new Uri('https://example.org/'));

		$this->assertSame('OPTIONS * HTTP/1.1', $request);
	}
}