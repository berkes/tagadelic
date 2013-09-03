<?php
namespace Drupal\tagadelic\Tests;

abstract class TagadelicTestBase extends \DrupalWebTestCase {
  protected $profile = 'testing';

  /**
   * @scope public
   * @returns Type  Description of return value
   */
  public function setUp(array $modules = array()) {
    $modules = array_merge($modules, array('tagadelic'));
    parent::setUp($modules);
  }
}
