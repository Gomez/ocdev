<?php
{% include app.small_license_header %}

namespace OCA\{{ app.namespace }}\Controller;


use \OCP\IRequest;
use \OCP\AppFramework\Http\TemplateResponse;
use \OCP\AppFramework\Http\JSONResponse;

use \OCA\{{ app.namespace }}\AppInfo\Application;


class PageControllerTest extends \PHPUnit_Framework_TestCase {

	private $container;

	public function setUp () {
		$app = new Application();
		$this->container = $app->getContainer();
	}


	public function testIndex () {
		// swap out request
		$this->container['Request'] = $this->getMockBuilder('\OCP\IRequest')
			->getMock();
		$this->container['UserId'] = 'john';

		$result = $this->container['PageController']->index();

		$this->assertEquals(array('user' => 'john'), $result->getParams());
		$this->assertEquals('main', $result->getTemplateName());
		$this->assertTrue($result instanceof TemplateResponse);
	}


	public function testEcho () {
		$result = $this->container['PageController']->doEcho('hi');

		$this->assertEquals(array('echo' => 'hi'), $result);
	}


}