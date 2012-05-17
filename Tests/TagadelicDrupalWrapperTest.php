<?php

require_once 'TagadelicDrupalWrapperTest.php';

class TagadelicDrupalWrapperTest extends PHPUnit_Framework_TestCase {
  /**
   * @var TagadelicDrupalWrapper
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->object = new TagadelicDrupalWrapper();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
  }
}
