<?php
class TagadelicTag {
  //available trough getters and setters only.
  private $id   = 0;
  private $name = "";# A human readable name for this tag.
  private $description = "";# A human readable piece of HTML-formatted text.

  //available trough setters only.
  private $link = ""; # Where this tag will point to. If left empty, tag will not be linked. Can be a full url too.
  private $count = 0; # Absolute count for the weight. Weight, i.e. tag-size will be extracted from this.
  private $dirty = true;

  //available trough getters only.
  private $weight = 0.0;

  function __construct($id, $name, $count, $description = "", $link = NULL) {
  }

  public function __ToString() {
    $this->clean();
    return l($this->name, $this->link, array("title" => $this->description));
  }

  /**
   * Getters
   **/
  public function get_id() {
    return $this->id;
  } 
  public function get_name() {
    $this->clean();
    return $this->name;
  }
  public function get_description() {
    $this->clean();
    return $this->description;
  }
  public function get_weight() {
    $this->recalculate();
    return $this->weight;
  }

  /**
   * Setters
   **/
  public function set_id($id) {
    $this->id = $id;
  }
  public function set_name($name) {
    $this->name = $name;
  }
  public function set_description($description) {
    $this->description = $description;
  }
  public function set_link($link) {
    $this->link = $link;
  }
  public function set_count($count) {
    $this->count = $count;
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
