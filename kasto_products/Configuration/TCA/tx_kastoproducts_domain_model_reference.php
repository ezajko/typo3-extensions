<?php

$ll = 'LLL:EXT:kasto_products/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => [
        'title'                    => $ll . 'tx_kastoproducts_domain_model_reference',
        'label'                    => 'title',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'sortby'                   => 'sorting',
        'cruser_id'                => 'cruser_id',
        'dividers2tabs'            => true,
        'versioningWS'             => true,
        'hideTable'                => true,

        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete'                   => 'deleted',

        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title,bodytext,image,',
        'iconfile'     => 'EXT:kasto_products/Resources/Public/Icons/product.svg'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, bodytext, image, product',
        'maxDBListItems' => 10,
        'maxSingleDBListItems' => 20,
    ],
    'palettes' => [
        'general' => [
            'showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,'
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => '--palette--;;general, title, bodytext, image, product,'
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 0,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config'  => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'special'    => 'languages',
                'items'      => [
                    //['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 0,
            'label'       => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    ['', 0],
                ],
                'foreign_table'       => 'tx_kastoproducts_domain_model_reference',
                'foreign_table_where' => 'AND tx_kastoproducts_domain_model_reference.pid=###CURRENT_PID### AND  ' .
                    'tx_kastoproducts_domain_model_reference.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'max'  => 255,
            ]
        ],
        'hidden' => [
            'exclude' => 0,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config'  => [
                'type' => 'check',
            ],
        ],
        'title' => [
            'exclude' => 0,
            'label'   => $ll . 'tx_kastoproducts_domain_model_reference.title',
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'bodytext' => [
            'exclude' => 0,
            'label'   => $ll . 'tx_kastoproducts_domain_model_reference.bodytext',
            'config'  => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'image' => [
            'exclude' => 0,
            'label'   => $ll . 'tx_kastoproducts_domain_model_reference.image',
            'config'  => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' =>
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
                    ],
                    'maxitems' => 1
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
        'product' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
