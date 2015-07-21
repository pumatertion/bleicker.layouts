<?php
namespace Bleicker\Layouts\Domain\Model;

/**
 * Class Column
 *
 * @package Bleicker\Layouts\Domain\Model
 */
interface ColumnInterface {

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
}