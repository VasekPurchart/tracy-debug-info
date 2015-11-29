<?php
/**
 * This file is part of the Nella Project (http://nella-project.org).
 *
 * Copyright (c) Patrik Votoček (http://patrik.votocek.cz)
 *
 * For the full copyright and license information,
 * please view the file LICENSE.md that was distributed with this source code.
 */

namespace Nella\Tracy;

class DebugInfoPanel
{

	/**
	 * @internal
	 * @param \Exception|NULL $e
	 * @return string[]|NULL
	 */
	public static function render(\Exception $e = NULL)
	{
		if (!$e instanceof \Nella\Tracy\DebugInfoException) {
			return NULL; // skip
		}

		return [
			'tab' => 'Exception Debug Info',
			'panel' => \Tracy\Dumper::toHtml($e->__debugInfo()),
		];
	}

	public static function register(\Tracy\BlueScreen $blueScreen)
	{
		$blueScreen->addPanel([static::class, 'render']);
	}

}
