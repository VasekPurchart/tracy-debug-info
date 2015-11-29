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

class TestException extends \Exception implements \Nella\Tracy\DebugInfoException
{

	use DebugInfoExceptionTrait;

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
