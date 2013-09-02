<?php
namespace Drupal\tagadelic\Tests;

class TagadelicTaxonomyTestBase extends TagadelicTestBase {

  /**
   * @scope public
   * @returns Type  Description of return value
   */
  public function setUp(array $modules = array()) {
    $modules = array_merge($modules, array('taxonomy', 'tagadelic_taxonomy'));
    parent::setUp($modules);
  }
}
