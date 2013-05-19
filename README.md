phpBB SEO Premod

================

The [phpBB SEO Premod](http://www.phpbb-seo.com/en/phpbb-seo-premod/seo-url-premod-t1549.html) is a fully Search Engine Optimization friendly premodded version of phpBB.

It is intended to simplify our mods usage and installation.


TRACKER
-------

If you want to report a bug or would like to report an improvement, please use our [tracker](http://phpbb-seo.coda-cola.net/projects/phpbb_seo_premod/issues).

CONTINUOUS INTEGRATION
----------------------

We have unit and functional tests in order to prevent regressions. These tests are performed by [Travis CI](http://travis-ci.org/).

Build Status: [![Build Status](https://secure.travis-ci.org/phpBBSEO/phpbb_seo_premod.png?branch=master)](http://travis-ci.org/phpBBSEO/phpbb_seo_premod)

BUILDING PACKAGES
-----------------


For building phpBB SEO Premod's packages you need to use [Phing](http://www.phing.info/trac/), available via PEAR.


On an Ubuntu box you need to install some packages before:

	sudo apt-get install zip


From the build directory, run:

	phing <target-name>


There are the following target available:

	- full-package: create a full phpBB SEO Premod package