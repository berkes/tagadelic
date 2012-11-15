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
    if(is_int($id)) {
      $this->id = $id;
    }
    else {
      throw new InvalidArgumentException();
    }

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
   * Instantiate and add a new tag to the cloud.
   * Wraps around "new TagadelicTag()" and adds to tags array.
   * @param id See TagadelicTag();
   * @param $name See TagadelicTag();
   * @param $description See TagadelicTag();
   * @param $link See TagadelicTag();
   *
   * returns $this, for chaining.
   */
  public function create_and_add_tag($id, $name, $count, $description = "", $link = NULL) {
    return $this->add_tag(new TagadelicTag($id, $name, $count, $description, $link));
  }

  /**
   * Instantiate $this from cache
   * Returns this 
   */
  public function from_cache($id, $drupal = NULL) {
    // For testing purposes
    // @TODO move to stub in tests.
    if ($drupal === NULL) {
      $drupal = new TagadelicDrupalWrapper();
    }
    $cache_id = "tagadelic_cloud_{$id}";
    return $drupal->cache_get($cache_id);
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

  /**
   * Writes the cloud to cache. Will recalculate if needed.
   * @return $this; for chaining.
   */
  private function cache_set() {
    $cache_id = "tagadedelic_{$this->id}";
    cache_set($cache_id, $this);
    return $this;
  }
}
