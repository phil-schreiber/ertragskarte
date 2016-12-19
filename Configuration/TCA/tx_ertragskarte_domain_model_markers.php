<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:ertragskarte/Resources/Private/Language/locallang_db.xlf:tx_ertragskarte_domain_model_markers',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,lng,ltd,place,zip,street,nr,acreage,yield,user,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('ertragskarte') . 'Resources/Public/Icons/tx_ertragskarte_domain_model_markers.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, cruser_id, hidden, title, lng, ltd, place, zip, street, nr, acreage, yield, user,gender,firstname,lastname,newsletter,terms,email',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, lng, ltd, place, zip, street, nr, acreage, yield, user,gender,firstname,lastname,newsletter,terms,email, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_ertragskarte_domain_model_markers',
				'foreign_table_where' => 'AND tx_ertragskarte_domain_model_markers.pid=###CURRENT_PID### AND tx_ertragskarte_domain_model_markers.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
             'tstamp' => array(
			'exclude' => 1,
			'label' => 'tstamp',
			'config' => array(
				'type' => 'none',
			),
		),
            
                'cruser_id' => array(
			'exclude' => 1,
			'label' => 'cruserid',
			'config' => array(
				'type' => 'none',
			),
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ertragskarte/Resources/Private/Language/locallang_db.xlf:tx_ertragskarte_domain_model_markers.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'lng' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ertragskarte/Resources/Private/Language/locallang_db.xlf:tx_ertragskarte_domain_model_markers.lng',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ltd' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ertragskarte/Resources/Private/Language/locallang_db.xlf:tx_ertragskarte_domain_model_markers.ltd',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'place' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ertragskarte/Resources/Private/Language/locallang_db.xlf:tx_ertragskarte_domain_model_markers.place',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'zip' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ertragskarte/Resources/Private/Language/locallang_db.xlf:tx_ertragskarte_domain_model_markers.zip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'street' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ertragskarte/Resources/Private/Language/locallang_db.xlf:tx_ertragskarte_domain_model_markers.street',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'nr' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ertragskarte/Resources/Private/Language/locallang_db.xlf:tx_ertragskarte_domain_model_markers.nr',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	'gender' => array(
			'exclude' => 1,
			'label' => 'Anrede',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	'firstname' => array(
			'exclude' => 1,
			'label' => 'Vorname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	'lastname' => array(
			'exclude' => 1,
			'label' => 'Nachname',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	'newsletter' => array(
			'exclude' => 1,
			'label' => 'Newsletter',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	'terms' => array(
			'exclude' => 1,
			'label' => 'Terms',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	'email' => array(
			'exclude' => 1,
			'label' => 'E-Mail',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'acreage' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ertragskarte/Resources/Private/Language/locallang_db.xlf:tx_ertragskarte_domain_model_markers.acreage',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'yield' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ertragskarte/Resources/Private/Language/locallang_db.xlf:tx_ertragskarte_domain_model_markers.yield',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'user' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:ertragskarte/Resources/Private/Language/locallang_db.xlf:tx_ertragskarte_domain_model_markers.user',
			'config' => array(
				'type' => 'select',
                                'items' => array (
                                    array('BayWa eigener Punkt',0),
                                ),
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
                                
			),
		),
		
	),
);