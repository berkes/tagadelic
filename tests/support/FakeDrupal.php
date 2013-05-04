<?php

/**
 * Fake Drupal stubs the global functions
 */
// @codeCoverageIgnoreStart
function cache_get() {
  $args = func_get_args();
  return __sig("cache_get", $args);
}
function cache_set() {
  $args = func_get_args();
  return __sig("cache_set", $args);
}
function check_plain() {
  $args = func_get_args();
  return __sig("check_plain", $args);
}
function l() {
  $args = func_get_args();
  return __sig("l", $args);
}

function __sig($func, $args) {
  foreach($args as $id => $arg) {
    if (is_array($arg) && !empty($arg)) {
      $args[$id] = serialize($arg);
    }
    elseif (is_array($arg) && empty($arg)) {
      $args[$id] = "Array";
    }
  }
  $arglist = join(',', $args);
  return "{$func}({$arglist})";
}
//@codeCoverageIgnoreEnd
