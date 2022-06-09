<?php declare(strict_types=1);
namespace Dadapas\HttpTests\Unit;

use PHPUnit\Framework\TestCase;
use Dadapas\Http\Request;

final class HeadersTest extends TestCase
{
	protected $message;

	/**
	 * @before
	*/
	protected function firstSetUp()
	{
		$this->message = new Request('GET', 'https://example.org');
	}

	public function test_ith_header()
	{
		$message = $this->message->withHeader('foo', 'bar');

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

	public function testMiltipleHeadersTest()
	{
		$message = $this->message
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