<?php

namespace Bleicker\Layouts\Domain\Model;

/**
 * Class Layout
 *
 * @package Bleicker\Layouts\Domain\Model
 */
class Layout implements LayoutInterface {

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
	 * @var ColumnGroup[]
	 */
	protected $columnGroups;

	/**
	 * @param string $identity
	 */
	public function __construct($identity) {
		$this->identity = (string)$identity;
		$this->columnGroups = [];
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
	 * @return ColumnGroup[]
	 */
	public function getColumnGroups() {
		return $this->columnGroups;
	}

	/**
	 * @param ColumnGroup[] $columnGroups
	 * @return $this
	 */
	public function setColumnGroups($columnGroups = []) {
		$this->columnGroups = $columnGroups;
		return $this;
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->getIdentity();
	}
}
