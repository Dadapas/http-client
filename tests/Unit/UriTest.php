<?php declare(strict_types=1);
namespace Dadapas\HttpTests\Unit;

use PHPUnit\Framework\TestCase;

final class UriTest extends TestCase
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