<?php
/**
 * Wrapper around Drupal Core functions. 
 * 
 * All Drupal core functionality we want to use and call in our lib is reproduced and wrapped here.
 * That way, e.g. cache_get() becomes TagadelicDrupalWrapper::cache_get().
 *
 * We don't, however, load and bootstrap Drupal. It is assumed to be loaded and bootstrapped.
 *   After all: Drupal calls and includes us, not the other way around.
 *   But it does leave us with interesting options when testing: we can then inlcude Drupal if needed. 
 *
 * Why? You ask? Because that way, backwards-incompatibility with version upgrades in Drupal is a minor change only in this file.
 *   We can very easily support new and old versions of Drupal by only changing this file.
 *   And we can test properly. Stubbing becomes a tad easier this way, making our tests truly isolated.
 */
class TagadelicDrupalWrapper {
  /*
   * http://api.drupal.org/api/drupal/includes!cache.inc/function/cache_get/7
   */
  public function cache_get($cid, $bin = 'cache') {
    return __cache_get($cid, $bin);
  }

  /*
   * http://api.drupal.org/api/drupal/includes!cache.inc/function/cache_set/7
   * Default $expire is different from original, NULL, since we don't have the 
   *  globals defined here.
   */
  public function cache_set($cid, $data, $bin = 'cache', $expire = NULL) {
    if ($expire === NULL) {
      return cache_set($cid, $data, $bin);
    }
    else {
      return cache_set($cid, $data, $bin, $expire);
    }
  }
}
