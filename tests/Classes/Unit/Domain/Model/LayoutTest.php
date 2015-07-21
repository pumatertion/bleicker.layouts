<?php

namespace Tests\Bleicker\Layouts\Unit\Domain\Model;

use Bleicker\Layouts\Domain\Model\Layout;
use Tests\Bleicker\Layouts\UnitTestCase;

/**
 * Class LayoutTest
 *
 * @package Tests\Bleicker\Layouts\Unit\Domain\Model
 */
class LayoutTest extends UnitTestCase {

	/**
	 * @test
	 */
	public function createTest() {
		$layout = Layout::create('foo');
		$this->assertInstanceOf(Layout::class, $layout);
	}

	/**
	 * @test
	 */
	public function getTitleTest() {
		$layout = Layout::create('foo');
		$title = $layout->setTitle('title')->getTitle();
		$this->assertEquals('title', $title);
	}
}
