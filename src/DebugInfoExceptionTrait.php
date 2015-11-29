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

trait DebugInfoExceptionTrait
{

	/**
	 * @return mixed[]|array
	 */
	public function __debugInfo()
	{
		$data = [];
		foreach ((array) $this as $key => $value) {
			if (strncmp($key, "\x00*\x00", 3) === 0 || strncmp($key, "\x00Exception\x00", 3) === 0) { // ignore internal
				continue;
			}

			$data[substr($key, strrpos($key, "\x00") + 1)] = $value;
		}

		return $data;
	}

}
