<?php

/**
 * Fake Drupal stubs the global functions
 */
// @codeCoverageIgnoreStart
function cache_get() {
  return __sig("cache_get", func_get_args());
}
function cache_set() {
  return __sig("cache_set", func_get_args());
}
function check_plain() {
  return __sig("check_plain", func_get_args());
}
function l() {
  return __sig("l", func_get_args());
}

function __sig($func, $args) {
  foreach($args as $id => $arg) {
    if (is_array($arg) && !empty($arg)) {
      $args[$id] = serialize($arg);
    }
  }
  $arglist = join(',', $args);
  return "{$func}({$arglist})";
}
//@codeCoverageIgnoreEnd
