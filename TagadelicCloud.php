<?php
/**
 * class TagadelicCloud
 *   TagadelicCloud, contains a list of tags and methods to manipulate
 *   this set of tags.
 *   It can operate on the list of tags.
 */
class TagadelicCloud {
  private $id = ""; # An identifier for this cloud. Must be unique.
  private $tags = array(); # List of the tags in this cloud.
  private $steps        = 6;  #Amount of steps to weight the cloud in. Defaults to 6. Means: 6 different sized tags.
  private $needs_recalc = true;

  public $fuck_locale = "";

  /**
   * Initalize the cloud
   *
   * @param id Integer, identifies this cloud; used for caching and 
   *        re-fetching of previously built clouds.
   * @param tags Array, provide tags on building. Tags can be added 
   *        later on, using `add_tag()` method.
   * @return TagadelicCloud.
   */
  function __construct($id, $tags = array()) {
    $this->id = $id;
    $this->tags = $tags;
  }

  /**
   * Getter for id
   * @ingroup getters
   * @returns Integer id of this cloud
   */
  public function get_id() {
    return $this->id;
  }

  /**
   * Getter for tags
   * @ingroup getters
   * @returns Array list of tags
   */
  public function get_tags() {
    $this->recalculate();
    return $this->tags;
  }

  /**
   * Add a new tag to the cloud
   * @param $tag TagadelicTag
   *   instance of TagadelicTag.
   *
   * return $this, for chaining.
   */
  public function add_tag($tag) {
    $this->tags[] = $tag;
    return $this;
  }

  /**
   * setter for drupal(wrapper). Mostly for testability
   * Operates on $this
   * Returns $this
   */
  public function set_drupal($drupal) {
    $this->drupal = $drupal;
    return $this;
  }

  /**
   * Getter for drupal
   * @return DrupalWrapper value in $this::$drupal.
   */
  public function drupal() {
    if (empty($this->drupal)) {
      $this->drupal = new TagadelicDrupalWrapper();
    }
    return $this->drupal;
  }

  /**
   * Instantiate $this from cache
   * Optionally pass $drupal, a Drupalwrapper along, mostly for testing.
   * Returns this
   */
  public static function from_cache($id, $drupal) {
    $cache_id = "tagadelic_cloud_{$id}";
    return $drupal->cache_get($cache_id);
  }

  /**
   * Writes the cloud to cache. Will recalculate if needed.
   * @return $this; for chaining.
   */
  public function to_cache() {
    $cache_id = "tagadelic_cloud_{$this->id}";
    $this->drupal()->cache_set($cache_id, $this);
    return $this;
  }

  /**
   * Sorts the tags by given property.
   * @return $this; for chaining.
   */
  public function sort($by_property) {
    if ($by_property == "random") {
      $this->drupal()->shuffle($this->tags);
    }
    else {
      //Bug in PHP https://bugs.php.net/bug.php?id=50688, lets supress the error.
      @usort($this->tags, array($this, "cb_sort_by_{$by_property}"));
    }
    return $this;
  }

  /**
   * (Re)calculates the weights on the tags.
   * @param $recalculate. Optional flag to enfore recalculation of the weights for the tags in this cloud.
   *        defaults to FALSE, meaning the value will be calculated once per cloud.
   *  @return $this; for chaining
   */
  private function recalculate() {
    $tags = array();
    // Find minimum and maximum log-count.
    $min = 1e9;
    $max = -1e9;
    foreach ($this->tags as $id => $tag) {
      $min = min($min, $tag->distributed());
      $max = max($max, $tag->distributed());
      $tags[$id] = $tag;
    }
    // Note: we need to ensure the range is slightly too large to make sure even
    // the largest element is rounded down.
    $range = max(.01, $max - $min) * 1.0001;
    foreach ($tags as $id => $tag) {
      $this->tags[$id]->set_weight(1 + floor($this->steps * ($tag->distributed() - $min) / $range));
    }
    return $this;
  }

  private function cb_sort_by_name($a, $b) {
    return strcoll($a->get_name(), $b->get_name());
  }

  private function cb_sort_by_count($a, $b) {
    $ac = $a->get_count();
    $bc = $b->get_count();
    if ($ac == $bc) {
      return 0;
    }
    //Highest first, High to low
    return ($ac < $bc) ? +1 : -1;
  }
}
