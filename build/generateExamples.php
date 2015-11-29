#!/usr/bin/env php
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

require_once __DIR__ . '/../vendor/autoload.php';

unset($_SERVER['HOMEBREW_GITHUB_API_TOKEN']);

class ClassicException extends \Exception
{

	/** @var int */
	private $userId;

	/** @var string */
	private $additionalInfo;

	/**
	 * @param int $userId
	 * @param string $additionalInfo
	 * @param \Exception|NULL $previous
	 */
	public function __construct($userId, $additionalInfo, \Exception $previous = NULL)
	{
		parent::__construct('Example exception', 42, $previous);

		$this->userId = $userId;
		$this->additionalInfo = $additionalInfo;
	}

	/**
	 * @return int
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * @return string
	 */
	public function getAdditionalInfo()
	{
		return $this->additionalInfo;
	}
}

class BetterException extends ClassicException implements \Nella\Tracy\DebugInfoException
{

	use \Nella\Tracy\DebugInfoExceptionTrait;

}

$examples = [
	'ClassicException' => new ClassicException(10242, 'Tracy is best!'),
	'BetterException' => new BetterException(10242, 'Tracy is best!'),
];

$blueScreen = new \Tracy\BlueScreen();
\Nella\Tracy\DebugInfoPanel::register($blueScreen);

foreach ($examples as $name => $exception) {
	$handle = @fopen(__DIR__ . '/example-' . $name . '.html', 'w');
	ob_start(); // double buffer prevents sending HTTP headers in some PHP
	ob_start(function ($buffer) use ($handle) {
		fwrite($handle, $buffer);
	}, 4096);
	$blueScreen->render($exception);
	ob_end_flush();
	ob_end_clean();
	fclose($handle);
}

echo 'DONE' . PHP_EOL . PHP_EOL;

