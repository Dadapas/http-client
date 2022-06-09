<?php declare(strict_types=1);
namespace Dadapas\HttpTests\Unit;

use PHPUnit\Framework\TestCase;

final class HeadersTest extends TestCase
{

	public function with_header_test()
	{
		$message = $message->withHeader('foo', 'bar');

		$this->assertSame('bar', $message->getHeaderLine('foo'));
		// Outputs: bar

		$this->assertSame('bar', $message->getHeaderLine('FOO'));
		// Outputs: bar

		$message = $message->withHeader('fOO', 'baz');

		$this->assertSame('baz', $message->getHeaderLine('foo'));
		// Outputs: baz

		$variable = 5;
		$this->assertSame(3, $variable, "$variable is not 3");
	}

	public function miltipleHeadersTest()
	{
		$message = $message
		    ->withHeader('foo', 'bar')
		    ->withAddedHeader('foo', 'baz');

		$header = $message->getHeaderLine('foo');
		$this->assertSame('bar,baz', $header);
		// $header contains: 'bar,baz'

		$header = $message->getHeader('foo');
		$this->assertSame(['bar', 'baz'], $header);
		// ['bar', 'baz']
	}
}