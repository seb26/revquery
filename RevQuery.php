<?php

/*
 * Copyright (c) 2011 seb26. All rights reserved.
 * Source code is licensed under the terms of the 3-clause Modified BSD License.
 *
 * MediaWiki is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software Foundation.
 * <http://www.mediawiki.org/>
 *
 */

if ( !defined( 'MEDIAWIKI' ) ) { die( 'This file is a MediaWiki extension, it is not a valid entry point' ); }

$wgExtensionCredits['parserhook'][] = array(
	'name' => 'RevQuery',
	'author' => 'seb26',
	'url' => 'https://github.com/seb26/mw-extensions',
	'description' => 'Adds file timestamps to image URL links to work better with caching systems'
	);

/*
 *
 * NOTE:

 * This extension does not use any hooks, and has no functionality introduced
 * with this particular file. URL timestamps are implemented by patching files
 * in MediaWiki's standard include files.
 *
 * $wgRevQueryTimestamps must be set to true to use this feature.
 *
 * This file exists to include a credit in [[Special:Version]]. This extension
 * cannot be properly installed by just including this file; your MediaWiki
 * install must first be patched. You can find the appropriate patch file
 * corresponding to your wiki's version at <https://github.com/seb26/revquery>.
 *
 */

/* This is the default setting. Please change this value in LocalSettings.php instead. */
$wgRevQueryTimestamps = false;
