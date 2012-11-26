# Tagadelic #

Tagadelic provides an API which allows developers to easily create
tagclouds, weighted lists, search-clouds and such.

With this API, two very simple modules are shipped that implement this, for your
ease and reference. Since the project is mostly a library, it is  mostly aimed
at developers who should use it as a library. 

But end-users can install and use the shipped modules right out of the box too.

* Create a tagcloud from taxonomy terms: terms used more often become
  larger, terms used less frequent are smaller.
* Create a weighted list of article-titles, based on the amount of
  "hits" they got.

## End-users ##
Install and enable _"tagadelic taxonomy"_ for a tagcloud from your
taxonomy-terms, and _"tagadelic titles"_ for a tagcloud from
article-titles. The required libaries and such will be installed
automatically.
Refer to the README of these modules for information on how and what to
configure.

## Developers ##
* Quick examples of usage go here. 

* Some examples showing advanced features go here.

* Some notes on including, dependencies and requirements go here.

## Contributing ##
* A note on pull requests here.

* A note on the issue-queue here.


### Testing ###
The library uses PHPUnit for testing the classes (the library) and
Drupals internal test-framework for testing the integration.

Please make sure all tests are green before making a pull-request; that
means testing with both phpunit and Drupals testing. For example:

    $ phpunit sites/all/modules/contrib/tagadelic/tests/*.php
    $ drush test-run

When introducting new features, make sure to add unit-tests for this;
The phpunit tests must have at least 100% coverage of all public
interfaces; There is no need to test protected and private methods and
attributes. But all public interaction must be covered.

When removing code or features, make sure to update the unit-tests.

# Contact #
More on http://github.com/berkes/tagadelic

Carpentered in the webschuur.com by Bèr Kessels
If you need custom work for this module, please contact me at <ber at
webschuur dot com>.
