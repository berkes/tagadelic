
<?php

require_once "TagadelicTagTest.php";

/**
 * Class TagadelicTagMethodsTest
 *
 * Test-group for testing the output-method __ToString from TagadelicTagTest.
 *   This is a functional group, with lots of duplication, hence it is extracted
 *   to its own Test.
 */
class TagadelicTagMethodsTest extends TagadelicTagTest {
  /**
   * @covers TagadelicTag::get_id
   */
  public function testGet_id() {
    $this->assertSame(42, $this->object->get_id());
  }

  /**
   * @covers TagadelicTag::get_name
   */
  public function testGet_name() {
    $this->assertSame("blackbeard", $this->object->get_name());
  }

  /**
   * @covers TagadelicTag::get_description
   */
  public function testGet_description() {
    $this->object->set_description("Foo Bar");
    $this->assertSame("Foo Bar", $this->object->get_description());
  }

  /**
   * @covers TagadelicTag::get_weight
   */
  public function testGet_weight() {
    $this->object->set_weight(123);
    $this->assertSame(123, $this->object->get_weight());
  }

  /**
   * @covers TagadelicTag::get_weight
   */
  public function testGet_count() {
    $this->assertSame(2, $this->object->get_count());
  }

  /**
   * @covers TagadelicTag::set_weight
   */
  public function testSet_weight() {
    $this->object->set_weight(123);
    $this->assertAttributeSame(123, "weight", $this->object);
  }

  /**
   * @covers TagadelicTag::set_drupal
   */
  public function testSet_drupal() {
    $drupal = $this->getMock("TagaDelicDrupalWrapper");
    $this->object->set_drupal($drupal);
    $this->assertAttributeSame($drupal, "drupal", $this->object);
  }

  /**
   * @covers TagadelicTag::drupal
   */
  public function testDrupal() {
    $drupal = $this->getMock("TagaDelicDrupalWrapper");
    $this->object->set_drupal($drupal);
    $this->assertSame($this->object->drupal(), $drupal);
  }

  /**
   * @covers TagadelicTag::drupal
   */
  public function testDrupalInstatiatesNewWrapper() {
    $this->object->set_drupal(NULL);
    $this->assertInstanceOf("TagaDelicDrupalWrapper", $this->object->drupal());
  }

  /**
   * @covers TagadelicTag::set_description
   */
  public function testSet_description() {
    $this->object->set_description("Foo Bar");
    $this->assertAttributeSame("Foo Bar", "description", $this->object);
  }

  /**
   * @covers TagadelicTag::set_link
   */
  public function testSet_link() {
    $this->object->set_link("tag/blackbeard");
    $this->assertAttributeSame("tag/blackbeard", "link", $this->object);
  }

  /**
   * @covers TagadelicTag::force_dirty
   */
  public function testForce_dirty() {
    $this->object->force_dirty();
    $this->assertAttributeSame(TRUE, "dirty", $this->object);
  }

  /**
   * @covers TagadelicTag::force_clean
   */
  public function testForce_clean() {
    $this->object->force_clean();
    $this->assertAttributeSame(FALSE, "dirty", $this->object);
  }

  /**
   * @covers TagadelicTag::clean()
   */
  public function testCleansWhenDirty() {
    $drupal = $this->getMock("TagaDelicDrupalWrapper");
    $drupal->expects($this->exactly(2))->method("check_plain");

    $this->object->set_drupal($drupal);
    $this->object->force_dirty();

    $this->object->get_name();
    $this->object->get_description();
  }

  /**
   * @covers TagadelicTag::clean()
   */
  public function testSkipsCleanWhenClean() {
    $drupal = $this->getMock("TagaDelicDrupalWrapper");
    $drupal->expects($this->never())->method("check_plain");

    $this->object->set_drupal($drupal);
    $this->object->force_clean();

    $this->object->get_name();
    $this->object->get_description();
  }
  /**
   * @covers TagadelicTag::distributed
   */
  public function testDistributed() {
    $this->assertSame(log(2), $this->object->distributed());
  }

  /**
   * @covers TagadelicTag::distributed
   */
  public function testDistributed_NotInfinite() {

    $this->object = new TagadelicTag(24, "redhair", 0);

    $this->assertFalse((is_infinite($this->object->distributed())));
  }

}
