<?php
defined('TYPO3_MODE') or die();

$ll = 'LLL:EXT:dkd_fuas_contacts/Resources/Private/Language/locallang_db.xlf:';

$fields = [
    'sys_language_uid' => [
        'exclude' => true,
        'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'special' => 'languages',
            'items' => [
                [
                    'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                    -1,
                    'flags-multiple'
                ],
            ],
            'default' => 0,
        ]
    ],
    'l10n_parent' => [
        'displayCond' => 'FIELD:sys_language_uid:>:0',
        'exclude' => true,
        'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['', 0],
            ],
            'foreign_table' => 'tt_address',
            'foreign_table_where' => 'AND tt_address.pid=###CURRENT_PID### AND tt_address.sys_language_uid IN (-1,0)',
            'default' => 0,
        ]
    ],
    'l10n_diffsource' => [
        'config' => [
            'type' => 'passthrough',
            'default' => ''
        ]
    ],
    'image' => array(
        'exclude' => 1,
        'label' => $generalLanguageFilePrefix . 'locallang_general.xml:LGL.image',
        'config' =>\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
            'image',
            array(
                'maxitems' => 1,
                'minitems' => 0,
                'appearance' => array(
                    'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
                ),
                'foreign_types' => array(
                    '0' => array(
                        'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                    ),
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
                        'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                    ),
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
                        'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                    ),
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
                        'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                    ),
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
                        'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                    ),
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
                        'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                    )
                )
            ),
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
        )
    ),
    'faculty' => [
        'exclude' => 0,
        'label' => $ll . 'tt_address.faculty',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectTree',
            'treeConfig' => [
                'parentField' => 'parent',
                'appearance' => [
                    'showHeader' => false,
                    'nonSelectableLevels' => 0,
                    'allowRecursiveMode' => true,
                    'expandAll' => true,
                    'maxLevels' => 99,
                    'width' => 650,
                    'height' => 300,
                ],
            ],
            'MM' => 'sys_category_record_mm',
            'MM_match_fields' => [
                'fieldname' => 'category',
                'tablenames' => 'tt_address',
            ],
            'MM_opposite_field' => 'items',
            'foreign_table' => 'sys_category',
            'foreign_table_where' => ' AND (sys_category.sys_language_uid = 0 OR sys_category.l10n_parent = 0) ORDER BY sys_category.title',
            'size' => 6,
            'autoSizeMax' => 10,
            'minitems' => 0,
            'maxitems' => 10,
        ]
    ],
    'field_of_expertise' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.field_of_expertise',
        'config' => [
            'type' => 'input',
            'size' => 48
        ],
    ],
    'phone2' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.phone2',
        'config' => [
            'type' => 'input',
            'size' => 30
        ],
    ],
    'phone3' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.phone3',
        'config' => [
            'type' => 'input',
            'size' => 30
        ],
    ],
    'email2' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.email2',
        'config' => [
            'type' => 'input',
            'size' => 48
        ],
    ],
    'email3' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.email3',
        'config' => [
            'type' => 'input',
            'size' => 48
        ],
    ],
    'languages' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.languages',
        'config' => [
            'type' => 'input',
            'size' => 48
        ],
    ],
    'caption_phone' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.caption_phone',
        'config' => [
            'type' => 'input',
            'size' => 30
        ],
    ],
    'caption_phone2' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.caption_phone2',
        'config' => [
            'type' => 'input',
            'size' => 30
        ],
    ],
    'caption_phone3' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.caption_phone3',
        'config' => [
            'type' => 'input',
            'size' => 30
        ],
    ],
    'caption_email' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.caption_email',
        'config' => [
            'type' => 'input',
            'size' => 30
        ],
    ],
    'caption_email2' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.caption_email2',
        'config' => [
            'type' => 'input',
            'size' => 30
        ],
    ],
    'caption_email3' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.caption_email3',
        'config' => [
            'type' => 'input',
            'size' => 30
        ],
    ],
    'caption_mobile' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.caption_mobile',
        'config' => [
            'type' => 'input',
            'size' => 30
        ],
    ],
    'np_phone' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.np_phone',
        'config' => [
            'type' => 'check',
        ],
    ],
    'np_phone2' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.np_phone2',
        'config' => [
            'type' => 'check',
        ],
    ],
    'np_phone3' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.np_phone3',
        'config' => [
            'type' => 'check',
        ],
    ],
    'np_email' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.np_phone',
        'config' => [
            'type' => 'check',
        ],
    ],
    'np_email2' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.np_email2',
        'config' => [
            'type' => 'check',
        ],
    ],
    'np_email3' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.np_email3',
        'config' => [
            'type' => 'check',
        ],
    ],
    'np_mobile' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.np_mobile',
        'config' => [
            'type' => 'check',
        ],
    ],
    'speaking_time' => [
        'exclude' => false,
        'label' => $ll . 'tt_address.speaking_time',
        'config' => [
            'type' => 'text',
            'cols' => 30,
            'rows' => 5,
            'softref' => 'rtehtmlarea_images,typolink_tag,images,email[subst],url',
            'wizards' => [
                'RTE' => [
                    'notNewRecords' => 1,
                    'RTEonly' => 1,
                    'type' => 'script',
                    'title' => 'Full screen Rich Text Editing',
                    'icon' => 'actions-wizard-rte',
                    'module' => [
                        'name' => 'wizard_rte',
                    ],
                ],
            ],
        ]
    ],
    'regular_courses' => [
        'exclude' => false,
        'label' => $ll . 'tt_address.regular_courses',
        'config' => [
            'type' => 'text',
            'cols' => 30,
            'rows' => 5,
            'softref' => 'rtehtmlarea_images,typolink_tag,images,email[subst],url',
            'wizards' => [
                'RTE' => [
                    'notNewRecords' => 1,
                    'RTEonly' => 1,
                    'type' => 'script',
                    'title' => 'Full screen Rich Text Editing',
                    'icon' => 'actions-wizard-rte',
                    'module' => [
                        'name' => 'wizard_rte',
                    ],
                ],
            ],
        ]
    ],
    'downloads' => [
        'exclude' => true,
        'l10n_mode' => 'mergeIfNotBlank',
        'label' => $ll . 'tt_address.downloads',
        'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
            'downloads',
            [
                'appearance' => [
                    'createNewRelationLinkTitle' => $ll . 'downloads.add',
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true
                ],
                'inline' => [
                    'inlineOnlineMediaAddButtonStyle' => 'display:none'
                ],
                'foreign_match_fields' => [
                    'fieldname' => 'downloads',
                    'tablenames' => 'tt_address',
                    'table_local' => 'sys_file',
                ],
            ]
        )
    ],
    'quicklinks' => [
        'exclude' => true,
        'l10n_mode' => 'mergeIfNotBlank',
        'label' => $ll . 'tt_address.quicklinks',
        'config' => [
            'type' => 'inline',
            'allowed' => 'tx_dkdfuascontacts_domain_model_link',
            'foreign_table' => 'tx_dkdfuascontacts_domain_model_link',
            'foreign_sortby' => 'sorting',
            'foreign_field' => 'parent',
            'size' => 5,
            'minitems' => 0,
            'maxitems' => 100,
            'appearance' => [
                'collapseAll' => true,
                'expandSingle' => true,
                'levelLinksPosition' => 'bottom',
                'useSortable' => true,
                'showPossibleLocalizationRecords' => true,
                'showRemovedLocalizationRecords' => true,
                'showAllLocalizationLink' => true,
                'showSynchronizationLink' => true,
                'enabledControls' => [
                    'info' => false,
                ]
            ]
        ]
    ],
    'content_elements' => [
        'exclude' => true,
        'l10n_mode' => 'mergeIfNotBlank',
        'label' => $ll . 'tt_address.content_elements',
        'config' => [
            'type' => 'inline',
            'allowed' => 'tt_content',
            'foreign_table' => 'tt_content',
            'foreign_sortby' => 'sorting',
            'foreign_field' => 'tt_address_id',
            'minitems' => 0,
            'maxitems' => 99,
            'appearance' => [
                'collapseAll' => true,
                'expandSingle' => true,
                'levelLinksPosition' => 'bottom',
                'useSortable' => true,
                'showPossibleLocalizationRecords' => true,
                'showRemovedLocalizationRecords' => true,
                'showAllLocalizationLink' => true,
                'showSynchronizationLink' => true,
                'enabledControls' => [
                    'info' => false,
                ]
            ]
        ]
    ],
    'contactfunction' => [
        'exclude' => true,
        'label' => $ll . 'tt_address.contactfunction',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['', 0],
            ],
            'foreign_table' => 'tx_dkdfuascontacts_domain_model_contactfunction',
            'foreign_table_where' => 'AND tx_dkdfuascontacts_domain_model_contactfunction.sys_language_uid IN (-1,0)',
            'default' => 0,
        ]
    ],
    'xing' => [
        'exclude' => 1,
        'label' => $ll . 'tt_address.xing',
        'config' => [
            'type' => 'input',
            'size' => '20',
            'eval' => 'trim',
            'max' => '255',
            'placeholder' => 'John_Doe'
        ]
    ],
    'position' => array(
        'exclude' => 1,
        'label' => $ll . 'tt_address.position',
        'config' => array(
            'type' => 'input',
            'size' => '20',
            'eval' => 'trim',
            'max' => '255'
        )
    ),
];

$GLOBALS['TCA']['tt_address']['ctrl']['languageField'] = 'sys_language_uid';
$GLOBALS['TCA']['tt_address']['ctrl']['transOrigPointerField'] = 'l10n_parent';
$GLOBALS['TCA']['tt_address']['ctrl']['transOrigDiffSourceField'] = 'l10n_diffsource';

$GLOBALS['TCA']['tt_address']['types']['0']['columnsOverrides']['description'] = [
    'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
];
$GLOBALS['TCA']['tt_address']['types']['0']['columnsOverrides']['speaking_time'] = [
    'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
];
$GLOBALS['TCA']['tt_address']['types']['0']['columnsOverrides']['regular_courses'] = [
    'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_address', $fields);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_address', 'sys_language_uid,l10n_parent, l10n_diffsource', '', 'after:hidden');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_address', 'image,faculty,contactfunction,field_of_expertise,languages', '', 'after:description');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_address', '--div--;' . $ll . 'tt_address.additional,speaking_time,regular_courses,downloads,quicklinks, --div--;' . $ll . 'tab.content_elements, content_elements', '');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_address', 'social', '--linebreak--,xing', 'after:linkedin');
$GLOBALS['TCA']['tt_address']['palettes']['contact']['showitem'] = 'email, caption_email, np_email, --linebreak--, email2, caption_email2, np_email2, --linebreak--, email3, caption_email3, np_email3, --linebreak--, mobile, caption_mobile, np_mobile, --linebreak--, phone, caption_phone, np_phone, --linebreak--, phone2, caption_phone2, np_phone2, --linebreak--, phone3, caption_phone3, np_phone3, --linebreak--, fax, --linebreak--, www';
