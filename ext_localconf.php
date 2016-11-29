<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Df.' . $_EXTKEY,
	'Markers',
	array(
		'Markers' => 'list, new, create, update, show, delete',
		
	),
	// non-cacheable actions
	array(
		'Markers' => 'new, create, update, delete',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Df.' . $_EXTKEY,
	'Ertragskarte',
	array(
		'Ertragskarte' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Ertragskarte' => 'list'
		
	)
);
