# Tagadelic #
Tagadelic provides an API and a few simple turnkey modules, which allows you to easily create tagclouds, weighted lists, search-clouds and such.

With the API you can build a module with a few lines of PHP, to turn anything that can be counted into a weighted cloud. Which can be presented to your users anyway and anywhere on your site.

With the turnkey modules, you can add a page that shows taxonomy-terms in a weighted cloud: terms that are used more often are bigger. Another module provides a page that shows article-titles in a cloud: titles from articles that are read more often appear bigger.

[![Build Status](https://travis-ci.org/berkes/tagadelic.png?branch=develop)](https://travis-ci.org/berkes/tagadelic)

## End-users ##
Install and enable _"tagadelic taxonomy"_ for a tagcloud from your
taxonomy-terms, and _"tagadelic titles"_ for a tagcloud from
article-titles. The required libaries and such will be installed
automatically.

### Documentation for end-users ###

* [Tagadelic Taxonomy](https://github.com/berkes/tagadelic/wiki/Tagadelic-Taxonomy)
* [Tagadelic Titles](https://github.com/berkes/tagadelic/wiki/Tagadelic-Titles)

## Developers ##

Tagadelic is essentially a set of classes with APIs that allow you to
build word-clouds from anything that can be counted. The end-user
modules described above, should be considered example- and
convenience-modules. Examples for you, when you want to develop your own
clouds. And convenience for the poor souls who cannot develop such
module :).

An example:

    <?php
    $anne   = new TagadelicTag("anne", "Anne Bonney", 9);
    $sadie  = new TagadelicTag("sadie", "Sadie the Goat", 3);
    $mary   = new TagadelicTag("mary", "Mary Read", 20);

    $cloud = new TagadelicCloud("Pirettes", array($anne, $sadie, $mary));

    foreach($cloud->get_tags() as $tag) {
      print $tag;
    }
    ?>

This will output:

    <a href="/" class="level4">Anne Bonney</a>
    <a href="/" class="level1">Sadie the Goat</a>
    <a href="/" class="level6">Mary Read</a

## Contributing ##

### Test-driven ###
The project is entirely test-driven. Both unit-tests and DrupalWebTests.

* Patches, feature-requests or pull-requests without tests will be closed without discussion.
* Patches, feature-requests or pull-requests with failing tests are okay, but please state that it is work in progress. Showing and sharing work anywhere in the Red-green-refactor cycle is fine, but should be clearly marked as such.
* Bug-reports that come with a (failing) test that reproduces the bug will get most priority.
* All changes must be covered with tests.
* All existing tests, that fail after your changes, must be either removed, changed or refactored. Please also provide a description why you think the changes to existing tests are good. (After all: the tests describe the API and the working. Changing tests, means backwards incompatibility).
* Refactoring gives bonus-points. Removing code even more. When you introduce duplication, there's a big chance your patch will be ignored.
* The phpunit tests must have at least 100% coverage of all public interfaces; There is no need to test protected and private methods and attributes. But all public interaction must be covered.

For unit-tests, run:

   $ phpunit tests/

For Drupal Integration Tests:

   $ drush -l foo.localhost/bar test-run Tagadelic

### Git ###

Please issue pull-requests on Github. Drupal issues and -patches will be
ignored.

### About PHPUnit for UnitTesting ###
The library uses PHPUnit for testing the classes (the library) and
Drupals internal test-framework for testing the integration 

Using a third party tool was nessecary, because DrupalUnitTestis basically
[unusable for actual unit testing of classes](http://stackoverflow.com/a/6046100/73673).

A note on speed: Unit-tests take under a second (on my machine). When you
see the total time getting over into a few seconds, there is something
severely wrong. In case you are used to DrupalWebTests, who take minutes
and sometimes entire hours to run. This also indicates that you should
consider making a unit-test instead of a web-test when possible.

### Code Style ###
Code style is not 100% Drupal-strict; this is by design. For example,
all strings are enclosed in "".  When and where possible, readability 
and clarity is chosen over Drupal-strictness or micro-optimisation.

Self-explanatory functions and parameters are used whereever possible.
They are therefore often not documented with Doxygen; self-documenting code is
preferred. Whenever you have doubts about the workings of a public method,
and it is not explained in additional doxygen docs, we should consider
that a bug and fix it.

Methods are as lean and small as possible. Nesting of logic (ifs in ifs
and such) is frowned upon. Public api is as small as possible; private
or protected is the default, unless we have real cases where the method
must be exposed.

Drupal is wrapped in a DrupalWrapper Class. So our code does not call
any Drupal-function (like `check_plain()`)immediately. This is to allow
real easy upgrading and testing.

# Contact #
More on http://github.com/berkes/tagadelic

Made by berk.es; Bèr Kessels
If you need custom work for this module, please contact me at <ber at
webschuur dot com>.
