<?php

namespace Bleicker\Layouts\Domain\Model;

/**
 * Class Column
 *
 * @package Bleicker\Layouts\Domain\Model
 */
class Column implements ColumnInterface {

	/**
	 * @var string
	 */
	protected $identity;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $description;

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

	/**
	 * @param string $title
	 * @return $this
	 */
	public function setTitle($title = NULL) {
		$this->title = $title;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $description
	 * @return $this
	 */
	public function setDescription($description = NULL) {
		$this->description = $description;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->getIdentity();
	}
}
