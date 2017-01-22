<?php
namespace IcyMat\WebsiteBundle\Test\Service;

use IcyMat\WebsiteBundle\Service\IcyMatWebsiteManager;

class IcyMatWebsiteManagerTest extends \PHPUnit_Framework_TestCase
{
	protected $manager;
	
	protected function setUp()
	{
		$this->manager = new IcyMatWebsiteManager($rootDir);
	}

	public function testDefaultUrl()
	{
		
		
		$this->assertEquals($count, count($urls), $message);
	}
}