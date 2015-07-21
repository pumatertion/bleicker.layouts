<?php

namespace Bleicker\Layouts\Domain\Model;

/**
 * Class ColumnGroup
 *
 * @package Bleicker\Layouts\Domain\Model
 */
class ColumnGroup implements ColumnGroupInterface {

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
	 * @var Column[]
	 */
	protected $columns;

	/**
	 * @param string $identity
	 */
	public function __construct($identity) {
		$this->identity = (string)$identity;
		$this->columns = [];
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
	 * @return Column[]
	 */
	public function getColumns() {
		return $this->columns;
	}

	/**
	 * @param Column[] $columns
	 * @return $this
	 */
	public function setColumns($columns = []) {
		$this->columns = $columns;
		return $this;
	}
}
