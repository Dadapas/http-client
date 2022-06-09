<?php declare(strict_types=1);
namespace Dadapas\HttpTests\Unit;

use Dadapas\Http\Uri;
use Dadapas\Http\Request;
use PHPUnit\Framework\TestCase;

final class UriTest extends TestCase
{
	private $request;

	/**
	 * @before
	 */
	protected function firstSetUp()
	{
		$this->request = new Request('GET', 'http://example.org');
	}

	public function testUri()
	{
		$uriOne = new Uri("https://yseref:mypass@www.urldecoder.org/lalao/mama?get=pass&pascla=265#fragment");
		$this->assertSame('https', $uriOne->getScheme(), "https scheme");


	}

	public function testOptions()
	{
		$request = $this->request
				->withMethod('OPTIONS')
				->withRequestTarget('*')
				->withUri(new Uri('https://example.org/'));

		$this->assertSame('OPTIONS * HTTP/1.1', $request);
	}
}