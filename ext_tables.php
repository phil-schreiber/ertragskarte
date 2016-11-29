<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Df.' . $_EXTKEY,
	'Markers',
	'Markers'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Df.' . $_EXTKEY,
	'Ertragskarte',
	'Ertragskarte'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Ertragskarte');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ertragskarte_domain_model_markers', 'EXT:ertragskarte/Resources/Private/Language/locallang_csh_tx_ertragskarte_domain_model_markers.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ertragskarte_domain_model_markers');
