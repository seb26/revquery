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
 *
 * This file does not append timestamps to any URLs; this is done by patching
 * files in MediaWiki's standard include files. To disable this feature,
 * $wgRevQueryTimestamps can be set to false in LocalSettings.php. To remove
 * the RevQuery changes, you can undo the patch using the -R flag with GNU patch.
 * Alternatively, you can redownload the MediaWiki archive and extract the
 * affected files to your install directory.
 *
 * Timestamps cannot be appended to URLs by simply including this file; your
 * MediaWiki install must first be patched. You can find the appropriate patch
 * corresponding to your wiki's version at <https://github.com/seb26/revquery>.
 *
 */

# This is the default setting.
# To disable timestamps, set this to false in LocalSettings.php instead.
$wgRevQueryTimestamps = true;

# {{filetimestamp:}} and {{filepathtimestamp:}} functions

$wgHooks['LanguageGetMagic'][] = 'wfRevQuery_LanguageGetMagic';
$wgHooks['ParserFirstCallInit'][] = 'wfRevQuery_ParserFirstCallInit';

function wfRevQuery_ParserFirstCallInit( $parser ) {
	$parser->setFunctionHook( 'file-ts', 'wfRevQuery_file_ts', SFH_OBJECT_ARGS );
	$parser->setFunctionHook( 'filepath-ts', 'wfRevQuery_filepath_ts', SFH_OBJECT_ARGS );
	return true;
}

function wfRevQuery_LanguageGetMagic( &$magicWords, $langCode ) {
	$magicWords['file-ts'] = array( 0, 'file-ts' );
	$magicWords['filepath-ts'] = array( 0, 'filepath-ts' );
	return true;
}

function wfRevQuery_file_ts( $parser, $frame, $args ) {
	$file = wfRevQuery_getFile( $parser, trim( $frame->expand( $args[0] ) ) );
	return $file ? $file->getTimestamp() : '';
}

function wfRevQuery_filepath_ts( $parser, $frame, $args ) {
	$file = wfRevQuery_getFile( $parser, trim( $frame->expand( $args[0] ) ) );
	if ( $file ) {
		global $wgServer;
		return $wgServer . $file->getURL() . '?t=' . $file->getTimestamp();
	}
	else {
		return '';
	}
}

function wfRevQuery_getFile( &$parser, $text ) {
	$title = Title::newFromText( $text, NS_FILE );
	$file = $parser->fetchFile( $title );

	if ( $file && $file->exists() ) {
		return $file;
	}
	else {
		return false;
	}

}
