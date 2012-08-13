<?php

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class RequestTest extends PHPUnit_Framework_TestCase {
	
	private $request = null;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		$this->request = new \ZendServerAPI\Request;	
		// TODO Auto-generated RequestTest::setUp()
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated RequestTest::tearDown()
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
}

