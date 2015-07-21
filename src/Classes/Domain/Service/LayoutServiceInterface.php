<?php
namespace Bleicker\Layouts\Domain\Service;

use Bleicker\Layouts\Domain\Model\ColumnInterface;
use Bleicker\Layouts\Domain\Service\Exception\ColumnGroupAlreadyExistsException;
use Bleicker\Layouts\Domain\Service\Exception\ColumnAlreadyExistsException;
use Bleicker\Layouts\Domain\Model\ColumnGroupInterface;
use Bleicker\Layouts\Domain\Service\Exception\LayoutAlreadyExistsException;
use Bleicker\Layouts\Domain\Model\LayoutInterface;
use Closure;

/**
 * Class LayoutService
 *
 * @package Bleicker\Layouts\Domain\Service
 */
interface LayoutServiceInterface {

	/**
	 * @param $identity
	 * @return bool
	 */
	public function hasColumn($identity);

	/**
	 * @param $identity
	 * @return bool
	 */
	public function hasColumnGroup($identity);

	/**
	 * @param string $identity
	 * @return ColumnInterface
	 * @throws ColumnAlreadyExistsException
	 */
	public function addColumn($identity);

	/**
	 * @param string $columnIdentity
	 * @param string $groupIdentity
	 * @return $this
	 */
	public function addColumnToGroup($columnIdentity, $groupIdentity);

	/**
	 * @param string $identity
	 * @return ColumnGroupInterface
	 */
	public function getColumnGroup($identity);

	/**
	 * @param string $identity
	 * @return Closure
	 */
	public static function columnFilter($identity);

	/**
	 * @param string $identity
	 * @return Closure
	 */
	public static function layoutFilter($identity);

	/**
	 * @param string $columnIdentity
	 * @param string $groupIdentity
	 * @return bool
	 */
	public function columnInGroup($columnIdentity, $groupIdentity);

	/**
	 * @param string $columnGroupIdentity
	 * @param string $layoutIdentity
	 * @return bool
	 */
	public function columnGroupInLayout($columnGroupIdentity, $layoutIdentity);

	/**
	 * @param string $identity
	 * @return ColumnInterface
	 */
	public function getColumn($identity);

	/**
	 * @param $identity
	 * @return bool
	 */
	public function hasLayout($identity);

	/**
	 * @param string $identity
	 * @return Closure
	 */
	public static function columnGroupFilter($identity);

	/**
	 * @return LayoutService
	 */
	public static function getInstance();

	/**
	 * @return $this
	 */
	public function prune();

	/**
	 * @param string $columnGroupIdentity
	 * @param string $layoutIdentity
	 * @return $this
	 */
	public function addColumnGroupToLayout($columnGroupIdentity, $layoutIdentity);

	/**
	 * @param string $identity
	 * @return LayoutInterface
	 */
	public function getLayout($identity);

	/**
	 * @param string $identity
	 * @return ColumnGroupInterface
	 * @throws ColumnGroupAlreadyExistsException
	 */
	public function addColumnGroup($identity);

	/**
	 * @param string $identity
	 * @return LayoutInterface
	 * @throws LayoutAlreadyExistsException
	 */
	public function addLayout($identity);
}