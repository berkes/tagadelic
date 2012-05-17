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

}
