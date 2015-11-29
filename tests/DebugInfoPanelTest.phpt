<?php
/**
 * Test: Nella\Tracy\DebugInfoPanel
 * @testCase
 *
 * This file is part of the Nella Project (http://nella-project.org).
 *
 * Copyright (c) Patrik Votoček (http://patrik.votocek.cz)
 *
 * For the full copyright and license information,
 * please view the file LICENSE.md that was distributed with this source code.
 */

namespace Nella\Tracy;

use Tester\Assert;

require_once __DIR__ . '/bootstrap.php';

class DebugInfoPanelTest extends \Tester\TestCase
{

	/** @var \Tracy\BlueScreen */
	private $blueScreen;

	public function setUp()
	{
		parent::setUp();

		$this->blueScreen = new \Tracy\BlueScreen();
		DebugInfoPanel::register($this->blueScreen);
	}

	public function testSimple()
	{
		$e = new \Nella\Tracy\TestException(1024, 'Tracy is best!');

		$html = $this->generate($e);

		Assert::match('%A%<h2><a%a%>Exception Debug Info</a></h2>%A%', $html);
		Assert::match('%A%<span%a%>userId</span>%s%=>%s%<span%a%>1024</span>%A%', $html);
		Assert::match('%A%<span%a%>additionalInfo</span>%s%=>%s%<span%a%>"Tracy is best!"</span>%A%', $html);
	}

	public function testParent()
	{
		$parent = new \Nella\Tracy\TestException(512, 'Nella is best!');
		$e = new \Nella\Tracy\TestException(1024, 'Tracy is best!', $parent);

		$html = $this->generate($e);

		Assert::match('%A%<h2><a%a%>Exception Debug Info</a></h2>%A%', $html);

		Assert::match('%A%<span%a%>userId</span>%s%=>%s%<span%a%>1024</span>%A%', $html);
		Assert::match('%A%<span%a%>additionalInfo</span>%s%=>%s%<span%a%>"Tracy is best!"</span>%A%', $html);

		Assert::match('%A%<span%a%>userId</span>%s%=>%s%<span%a%>512</span>%A%', $html);
		Assert::match('%A%<span%a%>additionalInfo</span>%s%=>%s%<span%a%>"Nella is best!"</span>%A%', $html);
	}

	public function testClassicException()
	{
		$e = new \Exception('Tracy is best!', 1024);

		$html = $this->generate($e);

		Assert::false(Assert::isMatching('%A%<h2><a%a%>Exception Debug Info</a></h2>%A%', $html));
		Assert::false(Assert::isMatching('%A%<span%a%>userId</span>%s%=>%s%<span%a%>1024</span>%A%', $html));
		Assert::false(Assert::isMatching('%A%<span%a%>additionalInfo</span>%s%=>%s%<span%a%>"Tracy is best!"</span>%A%', $html));
	}

	/**
	 * @param \Exception $e
	 * @return string
	 */
	private function generate(\Exception $e)
	{
		$output = '';

		ob_start(); // double buffer prevents sending HTTP headers in some PHP
		ob_start(function ($buffer) use (&$output) {
			$output .= $buffer;
		}, 4096);
		$this->blueScreen->render($e);
		ob_end_flush();
		ob_end_clean();

		return "<!DOCTYPE html>" . substr($output, strpos($output, "\n"));
	}

}

id(new DebugInfoPanelTest)->run(isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : NULL);
