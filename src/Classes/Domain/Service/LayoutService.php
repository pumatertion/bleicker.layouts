<?php

namespace Bleicker\Layouts\Domain\Service;

use Bleicker\Layouts\Domain\Model\Layout;
use Bleicker\Layouts\Domain\Model\Column;
use Bleicker\Layouts\Domain\Model\ColumnGroup;
use Bleicker\Layouts\Domain\Service\Exception\LayoutAlreadyExistsException;
use Bleicker\Layouts\Domain\Service\Exception\ColumnAlreadyExistsException;
use Bleicker\Layouts\Domain\Service\Exception\ColumnGroupAlreadyExistsException;
use Closure;

/**
 * Class LayoutService
 *
 * @package Bleicker\Layouts\Domain\Service
 */
class LayoutService implements LayoutServiceInterface {

	/**
	 * @var Layout[]
	 */
	protected $layouts;

	/**
	 * @var Column[]
	 */
	protected $columns;

	/**
	 * @var ColumnGroup[]
	 */
	protected $columnGroups;

	/**
	 * @var LayoutService
	 */
	protected static $instance;

	private function __construct() {
		$this->layouts = [];
		$this->columns = [];
		$this->columnGroups = [];
	}

	/**
	 * @return LayoutService
	 */
	public static function getInstance() {
		if (static::$instance === NULL) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	/**
	 * @param string $identity
	 * @return Layout
	 * @throws LayoutAlreadyExistsException
	 */
	public function addLayout($identity) {
		if ($this->hasLayout($identity)) {
			throw new LayoutAlreadyExistsException('Identity "' . $identity . '" already exists', 1437486165);
		}
		$layout = new Layout($identity);
		$this->layouts[] = $layout;
		return $layout;
	}

	/**
	 * @param $identity
	 * @return bool
	 */
	public function hasLayout($identity) {
		return (bool)count(array_filter($this->layouts, $this->layoutFilter($identity)));
	}

	/**
	 * @param string $identity
	 * @return Layout
	 */
	public function getLayout($identity) {
		$layouts = array_filter($this->layouts, $this->layoutFilter($identity));
		return array_shift($layouts);
	}

	/**
	 * @param string $identity
	 * @return Column
	 * @throws ColumnAlreadyExistsException
	 */
	public function addColumn($identity) {
		if ($this->hasColumn($identity)) {
			throw new ColumnAlreadyExistsException('Identity "' . $identity . '" already exists', 1437487768);
		}
		$column = new Column($identity);
		$this->columns[] = $column;
		return $column;
	}

	/**
	 * @param $identity
	 * @return bool
	 */
	public function hasColumn($identity) {
		return (bool)count(array_filter($this->columns, $this->columnFilter($identity)));
	}

	/**
	 * @param string $identity
	 * @return Column
	 */
	public function getColumn($identity) {
		$columns = array_filter($this->columns, $this->columnFilter($identity));
		return array_shift($columns);
	}

	/**
	 * @param string $identity
	 * @return ColumnGroup
	 * @throws ColumnGroupAlreadyExistsException
	 */
	public function addColumnGroup($identity) {
		if ($this->hasColumnGroup($identity)) {
			throw new ColumnGroupAlreadyExistsException('Identity "' . $identity . '" already exists', 1437488408);
		}
		$columnGroup = new ColumnGroup($identity);
		$this->columnGroups[] = $columnGroup;
		return $columnGroup;
	}

	/**
	 * @param $identity
	 * @return bool
	 */
	public function hasColumnGroup($identity) {
		return (bool)count(array_filter($this->columnGroups, $this->columnGroupFilter($identity)));
	}

	/**
	 * @param string $identity
	 * @return ColumnGroup
	 */
	public function getColumnGroup($identity) {
		$columnGroups = array_filter($this->columnGroups, $this->columnGroupFilter($identity));
		return array_shift($columnGroups);
	}

	/**
	 * @param string $identity
	 * @return Closure
	 */
	public static function layoutFilter($identity) {
		return function (Layout $layout) use ($identity) {
			return (string)$layout->getIdentity() === (string)$identity;
		};
	}

	/**
	 * @param string $identity
	 * @return Closure
	 */
	public static function columnFilter($identity) {
		return function (Column $column) use ($identity) {
			return (string)$column->getIdentity() === (string)$identity;
		};
	}

	/**
	 * @param string $identity
	 * @return Closure
	 */
	public static function columnGroupFilter($identity) {
		return function (ColumnGroup $columnGroup) use ($identity) {
			return (string)$columnGroup->getIdentity() === (string)$identity;
		};
	}

	/**
	 * @param string $columnGroupIdentity
	 * @param string $layoutIdentity
	 * @return $this
	 */
	public function addColumnGroupToLayout($columnGroupIdentity, $layoutIdentity) {
		$columnGroup = $this->getColumnGroup($columnGroupIdentity);
		$layout = $this->getLayout($layoutIdentity);
		if ($columnGroup === NULL) {
			$columnGroup = $this->addColumnGroup($columnGroupIdentity);
		}
		if ($layout === NULL) {
			$layout = $this->addLayout($layoutIdentity);
		}
		if (!$this->columnGroupInLayout($columnGroupIdentity, $layoutIdentity)) {
			$columnGroups = $layout->getColumnGroups();
			$columnGroups[] = $columnGroup;
			$layout->setColumnGroups($columnGroups);
		}
		return $this;
	}

	/**
	 * @param string $columnGroupIdentity
	 * @param string $layoutIdentity
	 * @return bool
	 */
	public function columnGroupInLayout($columnGroupIdentity, $layoutIdentity) {
		$layout = $this->getLayout($layoutIdentity);
		if ($layout === NULL) {
			return FALSE;
		}
		return (bool)count(array_filter($layout->getColumnGroups(), $this->columnGroupFilter($columnGroupIdentity)));
	}

	/**
	 * @param string $columnIdentity
	 * @param string $groupIdentity
	 * @return $this
	 */
	public function addColumnToGroup($columnIdentity, $groupIdentity) {
		$column = $this->getColumn($columnIdentity);
		$columnGroup = $this->getColumnGroup($groupIdentity);
		if ($column === NULL) {
			$column = $this->addColumn($columnIdentity);
		}
		if ($columnGroup === NULL) {
			$columnGroup = $this->addColumnGroup($groupIdentity);
		}
		if (!$this->columnInGroup($columnIdentity, $groupIdentity)) {
			$columns = $columnGroup->getColumns();
			$columns[] = $column;
			$columnGroup->setColumns($columns);
		}
		return $this;
	}

	/**
	 * @param string $columnIdentity
	 * @param string $groupIdentity
	 * @return bool
	 */
	public function columnInGroup($columnIdentity, $groupIdentity) {
		$columnGroup = $this->getColumnGroup($groupIdentity);
		if ($columnGroup === NULL) {
			return FALSE;
		}
		return (bool)count(array_filter($columnGroup->getColumns(), $this->columnFilter($columnIdentity)));
	}

	/**
	 * @return Layout[]
	 */
	public function getLayouts() {
		return $this->layouts;
	}

	/**
	 * @return $this
	 */
	public function prune() {
		$this->layouts = [];
		$this->columns = [];
		$this->columnGroups = [];
		return $this;
	}
}
