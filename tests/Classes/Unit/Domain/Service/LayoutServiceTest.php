<?php

namespace Tests\Bleicker\Layouts\Unit\Domain\Service;

use Bleicker\Layouts\Domain\Model\Column;
use Bleicker\Layouts\Domain\Model\ColumnGroup;
use Bleicker\Layouts\Domain\Model\Layout;
use Bleicker\Layouts\Domain\Service\LayoutService;
use Tests\Bleicker\Layouts\UnitTestCase;

/**
 * Class LayoutServiceTest
 *
 * @package Tests\Bleicker\Layouts\Unit\Domain\Service
 */
class LayoutServiceTest extends UnitTestCase {

	protected function tearDown() {
		parent::tearDown();
		$layoutService = LayoutService::getInstance();
		$layoutService->prune();
	}

	/**
	 * @test
	 */
	public function instanceTest() {
		$this->assertInstanceOf(LayoutService::class, LayoutService::getInstance());
	}

	/**
	 * @test
	 */
	public function singletonTest() {
		$this->assertEquals(LayoutService::getInstance(), LayoutService::getInstance());
	}

	/**
	 * @test
	 */
	public function addLayoutTest() {
		$this->assertInstanceOf(Layout::class, LayoutService::getInstance()->addLayout('foo'));
	}

	/**
	 * @test
	 * @expectedException \Bleicker\Layouts\Domain\Service\Exception\LayoutAlreadyExistsException
	 */
	public function addExistingLayoutTest() {
		LayoutService::getInstance()->addLayout('foo');
		LayoutService::getInstance()->addLayout('foo');
	}

	/**
	 * @test
	 */
	public function hasLayoutTest() {
		LayoutService::getInstance()->addLayout('foo');
		$this->assertTrue(LayoutService::getInstance()->hasLayout('foo'));
	}

	/**
	 * @test
	 */
	public function getLayoutTest() {
		$layout = LayoutService::getInstance()->addLayout('foo');
		$this->assertEquals($layout, LayoutService::getInstance()->getLayout('foo'));
	}

	/**
	 * @test
	 */
	public function addColumnTest() {
		$this->assertInstanceOf(Column::class, LayoutService::getInstance()->addColumn('foo'));
	}

	/**
	 * @test
	 * @expectedException \Bleicker\Layouts\Domain\Service\Exception\ColumnAlreadyExistsException
	 */
	public function addExistingColumnTest() {
		LayoutService::getInstance()->addColumn('foo');
		LayoutService::getInstance()->addColumn('foo');
	}

	/**
	 * @test
	 */
	public function hasColumnTest() {
		LayoutService::getInstance()->addColumn('foo');
		$this->assertTrue(LayoutService::getInstance()->hasColumn('foo'));
	}

	/**
	 * @test
	 */
	public function getColumnTest() {
		$column = LayoutService::getInstance()->addColumn('foo');
		$this->assertEquals($column, LayoutService::getInstance()->getColumn('foo'));
	}

	/**
	 * @test
	 */
	public function addColumnGroupTest() {
		$this->assertInstanceOf(ColumnGroup::class, LayoutService::getInstance()->addColumnGroup('foo'));
	}

	/**
	 * @test
	 * @expectedException \Bleicker\Layouts\Domain\Service\Exception\ColumnGroupAlreadyExistsException
	 */
	public function addExistingColumnGroupTest() {
		LayoutService::getInstance()->addColumnGroup('foo');
		LayoutService::getInstance()->addColumnGroup('foo');
	}

	/**
	 * @test
	 */
	public function hasColumnGroupTest() {
		LayoutService::getInstance()->addColumnGroup('foo');
		$this->assertTrue(LayoutService::getInstance()->hasColumnGroup('foo'));
	}

	/**
	 * @test
	 */
	public function getColumnGroupTest() {
		$columnGroup = LayoutService::getInstance()->addColumnGroup('foo');
		$this->assertEquals($columnGroup, LayoutService::getInstance()->getColumnGroup('foo'));
	}

	/**
	 * @test
	 */
	public function addColumnToGroupTest() {
		LayoutService::getInstance()->addColumnToGroup('foo', 'foo');
		$this->assertTrue(LayoutService::getInstance()->columnInGroup('foo', 'foo'));
	}

	/**
	 * @test
	 */
	public function addColumnGroupToLayoutTest() {
		LayoutService::getInstance()->addColumnGroupToLayout('foo', 'foo');
		$this->assertTrue(LayoutService::getInstance()->columnGroupInLayout('foo', 'foo'));
	}
}
