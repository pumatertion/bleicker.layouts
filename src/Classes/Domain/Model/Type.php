<?php

namespace Bleicker\Layouts\Domain\Model;

/**
 * Class Type
 *
 * @package Bleicker\Layouts\Domain\Model
 */
class Type {

	/**
	 * @var string
	 */
	protected $identity;

	/**
	 * @param string $identity
	 */
	public function __construct($identity) {
		$this->identity = (string)$identity;
	}

	/**
	 * @param string $identity
	 * @return static
	 */
	public static function create($identity) {
		return new static($identity);
	}

	/**
	 * @return string
	 */
	public function getIdentity() {
		return $this->identity;
	}
}
