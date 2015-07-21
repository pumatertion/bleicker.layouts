<?php
namespace Bleicker\Layouts\Domain\Model;

/**
 * Class ColumnGroup
 *
 * @package Bleicker\Layouts\Domain\Model
 */
interface ColumnGroupInterface {

	/**
	 * @return string
	 */
	public function getDescription();

	/**
	 * @return string
	 */
	public function getIdentity();

	/**
	 * @return ColumnInterface[]
	 */
	public function getColumns();

	/**
	 * @return string
	 */
	public function getTitle();

	/**
	 * @return string
	 */
	public function __toString();
}