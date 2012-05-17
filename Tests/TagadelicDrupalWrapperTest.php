<?php

require_once 'TagadelicDrupalWrapper.php';

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

  /**
   * @covers TagadelicDrupalWrapper::cache_get
   * @todo: implement "asserts calls method" after http://stackoverflow.com/questions/10634925/assert-that-a-function-gets-called/10635477#10635477
   */
  public function testCache_get() {
    $this->assertTrue(method_exists($this->object, "cache_get"));
  }
  /**
   * @covers TagadelicDrupalWrapper::cache_set
   * @todo: implement "asserts calls method" after http://stackoverflow.com/questions/10634925/assert-that-a-function-gets-called/10635477#10635477
   */
  public function testCache_set() {
    $this->assertTrue(method_exists($this->object, "cache_set"));
  }
}
