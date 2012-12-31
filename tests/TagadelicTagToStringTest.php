<?php

require_once "TagadelicTagTest.php";

/**
 * Class Tagadelictagtostringtest 
 *
 * Test-group for testing the output-method __ToString from TagadelicTagTest.
 *   This is a functional group, with lots of duplication, hence it is extracted
 *   to its own Test.
 */
class TagadelicTagToStringTest extends TagadelicTagTest {
  protected function setUp() {
    parent::setUp();
  }
  /**
   * @covers TagadelicTag::__ToString
   * @todo   Implement test__ToString().
   */
  public function test__ToString() {
    $this->drupal->expects($this->once())
         ->method('l')
         ->will($this->returnValue("<a>blackbeard</a>"));
    $this->assertTag(array("tag" => "a", "content" => "blackbeard"), $this->object->__ToString());
  }

  /**
   * @covers tagadelictag::__tostring
   */
  public function test__ToStringHasLink() {
    $link = '/foo/bar';
    $this->object->set_link($link);

    $this->drupal->expects($this->any())
        ->method('l')
        ->with(
          $this->anything(),
          $this->equalto($link),
          $this->anything())
        ->will($this->returnvalue(""));

    $this->object->__tostring();
  }

  /**
   * @covers tagadelictag::__tostring
   */
  public function test__ToStringHasWeight() {
    $this->object->set_weight(3);
    $expected_attrs = array("title" => "", "class" => "weight-3");

    $this->drupal->expects($this->any())
        ->method('l')
        ->with(
          $this->anything(),
          $this->anything(),
          $this->equalto($expected_attrs))
        ->will($this->returnvalue(""));

    $this->object->__tostring();
  }
}

