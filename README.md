RevQuery
====================

**RevQuery** is an extension for [MediaWiki](http://www.mediawiki.org/wiki/MediaWiki), an open-source wiki software package, written by **seb26**. The extension adds the revision timestamp of a file to its embedded <img> source URL as a query parameter. This enables Varnish and other caching systems to correctly display thumbnails when a new file revision is uploaded.

For example:

    <img alt="Image.png" src="/w/images/0/0a/Image.png" width="100" height="100">

... becomes:

    <img alt="Image.png" src="/w/images/0/0a/Image.png?t=20120127161655" width="100" height="100">

Installation
------------

The following code should be added to `LocalSettings.php`:

    require_once( "$IP/extensions/RevQuery/RevQuery.php" );

**Important**: RevQuery requires modifications to local MediaWiki files.

* Select a `.patch` file corresponding to your MediaWiki version and apply it your installation.
* Available patches (see tree):
    * `mediawiki-1.18.1.patch` &ndash; modifies `includes/Linker.php` and `includes/media/MediaTransformOutput.php`

Development
-----------

**Testing**

* Developed for stable branch (currently **1.18.1**), tests only performed on this version.
* Untested on 1.17.1 or lower.

**TODO**

* Add functionality to enable timestamps on file page thumbnails.

Licensing
---------

All extensions are copyright (c) 2011 **seb26**. Source code is free to be modified or distributed under the terms of the Modified BSD License. MediaWiki is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation.
