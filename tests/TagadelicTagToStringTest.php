<?php

require_once "TagadelicTagTest.php";

/**
 * Class Tagadelictagtostringtest 
 *
 * Test-group for testing the output-method __ToString from TagadelicTagTest.
 *   This is a functional group, with lots of duplication, hence it is extracted
 *   to its own Test.
 *
 *  @TODO: find a way to stub a basic implementation and then 
 *   override that http://stackoverflow.com/q/14100185/73673
 */
class TagadelicTagToStringTest extends TagadelicTagTest {
  protected function setUp() {
    parent::setUp();
    $this->drupal->expects($this->once())
         ->method('l')
         ->will($this->returnValue("<a>blackbeard</a>"));
  }
  /**
   * @covers TagadelicTag::__ToString
   */
  public function test__ToString() {
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
          $this->anything());

    $this->object->__tostring();
  }

  /**
   * @covers tagadelictag::__tostring
   */
  public function test__ToStringHasTitle() {
    $this->object->set_description("Foo Bar");
    $expected_attrs = array("title" => "Foo Bar");

    $this->drupal->expects($this->any())
        ->method('l')
        ->with(
          $this->anything(),
          $this->anything(),
          $this->equalto(array("attributes" => $expected_attrs)))
        ->will($this->returnvalue(""));

    $this->object->__tostring();
  }

  /**
   * @covers tagadelictag::__tostring
   */
  public function test__ToStringHasNoTitle() {
    $this->object->set_description("");

    $this->drupal->expects($this->any())
        ->method('l')
        ->with(
          $this->anything(),
          $this->anything(),
          $this->equalto(array()))
        ->will($this->returnvalue(""));

    $this->object->__tostring();
  }

  /**
   * @covers tagadelictag::__tostring
   */
  public function test__ToStringHasWeight() {
    $this->object->set_weight(3);
    $expected_attrs = array("class" => array("level3"));

    $this->drupal->expects($this->any())
        ->method('l')
        ->with(
          $this->anything(),
          $this->anything(),
          $this->equalto(array("attributes" => $expected_attrs)))
        ->will($this->returnvalue(""));

    $this->object->__tostring();
  }

  /**
   * @covers tagadelictag::__tostring
   */
  public function test__ToStringHasNoWeight() {
    $this->object->set_weight(0);

    $this->drupal->expects($this->any())
        ->method('l')
        ->with(
          $this->anything(),
          $this->anything(),
          $this->equalto(array()))
        ->will($this->returnvalue(""));

    $this->object->__tostring();
  }
}

