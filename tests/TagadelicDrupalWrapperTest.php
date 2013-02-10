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
    require_once "tests/support/FakeDrupal.php";
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
   */
  public function testCache_get() {
    $this->assertTrue(method_exists($this->object, "cache_get"));
    $this->assertSame($this->object->cache_get(1337), "cache_get(1337,cache)");
    $this->assertSame($this->object->cache_get(1337,"custom"), "cache_get(1337,custom)");
  }

  /**
   * @expectedException PHPUnit_Framework_Error
   */
  public function testCache_get_requires_cid() {
    $this->object->cache_get();
  }

  /**
   * @covers TagadelicDrupalWrapper::cache_set
   */
  public function testCache_set() {
    $this->assertTrue(method_exists($this->object, "cache_set"));
    $this->assertSame($this->object->cache_set(1337, "hello"), "cache_set(1337,hello,cache)");
    $this->assertSame($this->object->cache_set(1337, "hello","custom"), "cache_set(1337,hello,custom)");
    $this->assertSame($this->object->cache_set(1337, "hello","custom", 280602000), "cache_set(1337,hello,custom,280602000)");
  }

  /**
   * @expectedException PHPUnit_Framework_Error
   */
  public function testCache_set_requires_cid() {
    $this->object->cache_set();
  }
  /**
   * @expectedException PHPUnit_Framework_Error
   */
  public function testCache_set_requires_data() {
    $this->object->cache_set(1337);
  }

  /**
   * @covers TagadelicDrupalWrapper::check_plain
   */
  public function testCheck_plain() {
    $this->assertTrue(method_exists($this->object, "check_plain"));
    $this->assertSame($this->object->check_plain("hello"), "check_plain(hello)");
  }

  /**
   * @expectedException PHPUnit_Framework_Error
   */
  public function testCheck_plain_requires_text() {
    $this->object->check_plain();
  }

  public function testL() {
    $this->assertTrue(method_exists($this->object, "l"));
    $this->assertSame($this->object->l("text", "path"), "l(text,path,Array)");

    $options = array("attributes"=>array("title"=>"foo"));
    $serialized = serialize($options);
    $this->assertSame($this->object->l("text", "path", $options),"l(text,path,{$serialized})");
  }

  /**
   * @expectedException PHPUnit_Framework_Error
   */
  public function testL_requires_text() {
    $this->object->l();
  }
  /**
   * @expectedException PHPUnit_Framework_Error
   */
  public function testL_requires_path() {
    $this->object->l("text");
  }

  /**
   * @covers TagadelicDrupalWrapper::shuffle
   */
  public function testShuffle() {
    $array_to_shuffle = array("a", "b");
    $this->assertTrue(method_exists($this->object, "shuffle"));
    //Cannot test the method signature, because we cannot redeclare global "shuffle()"
  }

  /**
   * @expectedException PHPUnit_Framework_Error
   */
  public function testShuffle_requires_array() {
    $this->object->shuffle();
  }
}

