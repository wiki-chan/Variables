<?php

/**
 * 'Variables' introduces parser functions for defining page-scoped variables within
 * wiki pages.
 *
 * Documentation: https://www.mediawiki.org/wiki/Extension:Variables
 * Support:       https://www.mediawiki.org/wiki/Extension_talk:Variables
 * Source code:   https://svn.wikimedia.org/viewvc/mediawiki/trunk/extensions/Variables
 *
 * @license: ISC License
 * @author: Rob Adams
 * @author: Tom Hempel
 * @author: Xiloynaha
 * @author: Daniel Werner < danweetz@web.de >
 *
 * @file Variables.php
 * @ingroup Variables
 */

if ( ! defined( 'MEDIAWIKI' ) ) { die(); }

$wgExtensionCredits['parserhook'][] = array(
	'path'           => __FILE__,
	'name'           => 'Variables',
	'descriptionmsg' => 'variables-desc',
	'version'        => '2.1.0',
	'author'         => array( 'Rob Adams', 'Tom Hempel', 'Xiloynaha', '[https://www.mediawiki.org/wiki/User:Danwe Daniel Werner]', '페네트-' ),
	'url'            => 'https://github.com/wiki-chan/Variables',
);

// language files:
$wgMessagesDirs['Variables'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['Variables'     ] = dirname( __FILE__ ) . '/Variables.i18n.php';
$wgExtensionMessagesFiles['VariablesMagic'] = dirname( __FILE__ ) . '/Variables.i18n.magic.php';

// hooks registration:
$wgHooks['ParserFirstCallInit'     ][] = 'ExtVariables::init';
$wgHooks['ParserClearState'        ][] = 'ExtVariables::onParserClearState';

// parser tests registration:
$wgParserTestFiles[] = dirname( __FILE__ ) . '/tests/mwparsertests/Variables.txt';

if( version_compare( $wgVersion, '1.20', '<' ) ) {
	// fallback for InternalParseBeforeSanitize hook
	$wgHooks['InternalParseBeforeLinks'][] = 'ExtVariables::onInternalParseBeforeLinks';
} else {
	// this hook is available from MW 1.20 on
	$wgHooks['InternalParseBeforeSanitize'][] = 'ExtVariables::onInternalParseBeforeSanitize';
}

// Include the settings file:
require_once dirname( __FILE__ ) . '/Variables.settings.php';

$wgAutoloadClasses['ExtVariables'] = dirname( __FILE__ ) . '/Variables.class.php';