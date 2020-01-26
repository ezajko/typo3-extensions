<?php

$ll = 'LLL:EXT:kasto_products/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => [
        'title'                    => $ll . 'tx_kastoproducts_domain_model_url',
        'label'                    => 'value',
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
            'disabled'  => 'hidden',
        ],
        'searchFields' => 'value,',
        'iconfile'     => 'EXT:kasto_products/Resources/Public/Icons/product.svg'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, value',
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
            'showitem' => 'general, value, product,'
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
                'foreign_table'       => 'tx_kastoproducts_domain_model_url',
                'foreign_table_where' => 'AND tx_kastoproducts_domain_model_url.pid=###CURRENT_PID### AND  ' .
                    'tx_kastoproducts_domain_model_url.sys_language_uid IN (-1,0)',
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
        'value' => [
            'exclude' => 0,
            'label'   => $ll . 'tx_kastoproducts_domain_model_url.value',
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'product' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
