<?php
/**
 * class TagadelicTag
 *   TagadelicTag contains the tag itself.
 */
class TagadelicTag {
  private $id   = 0;         # Identifier of this tag
  private $name = "";        # A human readable name for this tag.
  private $description = ""; # A human readable piece of HTML-formatted text.

  private $link = "";        # Where this tag will point to. If left empty, tag will not be linked. Can be a full url too.
  private $count = 0;        # Absolute count for the weight. Weight, i.e. tag-size will be extracted from this.
  private $dirty = true;

  private $weight = 0.0;

  /**
   * Initalize this tag
   * @param id Integer the identifier of this tag
   * @param name String a human readable name describing this tag
   */
  function __construct($id, $name, $count) {
  }

  /**
   * Magic method to render the Tag.
   *  turns the tag into an HTML link to its source.
   */
  public function __ToString() {
    $this->clean();
    return l($this->name, $this->link, array("title" => $this->description));
  }

  /**
   * Getter for the ID
   * @ingroup getters
   * return Integer Identifier
   **/
  public function get_id() {
    return $this->id;
  } 

  /**
   * Getter for the name
   * @ingroup getters
   * return String the human readable name
   **/
  public function get_name() {
    $this->clean();
    return $this->name;
  }

  /**
   * Getter for the description
   * @ingroup getters
   * return String the human readable description
   **/
  public function get_description() {
    $this->clean();
    return $this->description;
  }

  /**
   * Returns the weight, getter only.
   *   Will call recalculate to calculate the weight.
   * @ingroup getters
   * return Float the weight of this tag.
   **/
  public function get_weight() {
    $this->recalculate();
    return $this->weight;
  }

  /**
   * Sets the optional description.
   * A tag may have a description
   * @param $description String a description
   */
  public function set_description($description) {
    $this->description = $description;
  }

  /**
   * Link to a resource.
   * @param link String Optional a link to a resource that represents 
   *        the tag. e.g. a listing with all things tagged with Tag, or 
   *        the article that represents the tag.
   */
  public function set_link($link) {
    $this->link = $link;
  }

  /**
   * setter for weight
   * Operates on $this
   * Returns $this
   */
  public function set_weight($weight) {
    $this->weight = $weight;
    return $this;
  }

  /**
   * Flag $name and $description as dirty; none-cleaned.
   *  BEWARE! This will probably lead to double escaping, unless you know what you are doing.
   */
  public function force_dirty() {
    $this->dirty = true;
  }

  /**
   * Flag $name and $description as safe. 
   *  XSS-escaping and sanitizing is left to implementer. 
   *  BEWARE! Only enforce when you know what you are doing. Seriously!
   */
  public function force_clean() {
    $this->dirty = false;
  }

  /**
   * Calculates a more evenly distributed value.
   */
  public function distributed() {
    return log($this->count);
  }

  /**
    * Utility, to enforce XSS filtering on strings before they are
    * printed or returned.
    **/
  private function clean() {
    if ($this->dirty) {
      $this->name = check_plain($name);
      $this->description = check_plain($this->description);
    }
  }
}
