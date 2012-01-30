RevQuery
====================

**RevQuery** is an extension for [MediaWiki](http://www.mediawiki.org/wiki/MediaWiki), an open-source wiki software package, written by **seb26**. The extension adds the revision timestamp of a file to its embedded `<img>` source URL as a query parameter. This enables Varnish and other caching systems to appropriately recache and display correct thumbnails when a new file revision is made.

For example:

    <img alt="Image.png" src="/w/images/0/0a/Image.png" width="100" height="100">

... becomes:

    <img alt="Image.png" src="/w/images/0/0a/Image.png?t=20120127161655" width="100" height="100">

RevQuery also adds timestamps to all thumbnails on file pages (including previous revisions).

Installation
------------

The following code should be added to `LocalSettings.php`:

    require_once( "$IP/extensions/RevQuery/RevQuery.php" );
        $wgRevQueryTimestamps = true;

#### Note: RevQuery requires modifications to be made to your MediaWiki installation.

* Select a `.patch` file corresponding to your MediaWiki version and apply it your installation.
* Available patches (see also tree):
    * [`RevQuery-mediawiki-1.18.1.patch`](https://raw.github.com/seb26/revquery/master/RevQuery-mediawiki-1.18.1.patch) &ndash; files modified:
        * `includes/media/MediaTransformOutput.php`
        * `includes/ImagePage.php`
        * `includes/Linker.php`
    * [`RevQuery-mediawiki-1.17.2.patch`](https://raw.github.com/seb26/revquery/master/RevQuery-mediawiki-1.17.2.patch) &ndash; files modified:
        * `includes/media/MediaTransformOutput.php`
        * `includes/ImagePage.php`
        * `includes/Linker.php`
    * [`RevQuery-mediawiki-1.16.5.patch`](https://raw.github.com/seb26/revquery/master/RevQuery-mediawiki-1.16.5.patch) &ndash; files modified:
        * `includes/MediaTransformOutput.php`
        * `includes/ImagePage.php`
        * `includes/Linker.php`

#### Why does this require patching?

There are no extension hooks in the right places that allow timestamps to be added to URLs. An alternative would be to use the `BeforePageDisplay` hook; however, this would require the output HTML string to be scraped for `<img>` tags. The changes in RevQuery patches do not affect other components of the software.

Development
-----------

**Testing**

* Developed for stable branch (1.18.1), legacy branch (1.17.2) and deprecated version (1.16.5).

**TODO**

* Test on 1.18.0, see if 1.18.1 patch can be applied cleanly.
* `{{filepath:}}` links; determine whether or not to automatically add timestamps to these, or offer alternative functions (e.g. `{{filepathcurrent:}}`).

Licensing
---------

All extensions are copyright (c) 2011 **seb26**. Source code is free to be modified or distributed under the terms of the Modified BSD License. MediaWiki is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation.
