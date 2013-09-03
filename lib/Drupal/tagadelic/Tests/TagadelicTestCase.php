<?php
namespace Drupal\tagadelic\Tests;

class TagadelicTestCase extends TagadelicTestBase {
  /**
   * getInfo sets information about this test
   *
   * @scope public static
   * @returns Array  Descriptive array for this test
   */
  public static function getInfo() {
    return array(
      "name" => "Tagadelic Test",
      "description" => "Tests if Tagadelic correctly adds the libraries",
      "group" => "Tagadelic",
    );
  }

  /**
   * testAutoloader Tests if classes are autoloaded.
   * @covers TagadelicCloud, TagadelicTag, TagaDelicDrupalWrapper.
   * @scope public
   */
  public function testAutoloader() {
    $tag    = new \TagadelicTag(12, "jane", 2);
    $cloud  = new \TagadelicCloud(1337);
    $drupal = new \TagaDelicDrupalWrapper();

    $this->assertEqual("TagadelicTag"           , get_class($tag));
    $this->assertEqual("TagadelicCloud"         , get_class($cloud));
    $this->assertEqual("TagadelicDrupalWrapper" , get_class($drupal));
  }
}
