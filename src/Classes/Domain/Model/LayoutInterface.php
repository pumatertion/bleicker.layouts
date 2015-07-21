<?php
namespace Bleicker\Layouts\Domain\Model;

/**
 * Class Layout
 *
 * @package Bleicker\Layouts\Domain\Model
 */
interface LayoutInterface {

	/**
	 * @return string
	 */
	public function getDescription();

	/**
	 * @return string
	 */
	public function getIdentity();

	/**
	 * @return string
	 */
	public function getTitle();

	/**
	 * @return ColumnGroupInterface[]
	 */
	public function getColumnGroups();
}