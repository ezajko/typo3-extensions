<?php

$ll = 'LLL:EXT:kasto_products/Resources/Private/Language/locallang_db.xlf:';

$types = [
    'sawMachinesTypeId'    => 1,
    'storageSystemsTypeId' => 2,
    'accessoriesTypeId'    => 3,
    'servicesTypeId'       => 4,
    'systemsTypeId'        => 6
];

return [
    'ctrl' => [
        'title'                    => $ll . 'tx_kastoproducts_domain_model_product',
        'label'                    => 'title',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'sortby'                   => 'sorting',
        'cruser_id'                => 'cruser_id',
        'dividers2tabs'            => true,
        'versioningWS'             => true,

        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete'                   => 'deleted',

        'enablecolumns' => [
            'disabled'  => 'hidden',
            'starttime' => 'starttime',
            'endtime'   => 'endtime',
        ],
        'searchFields' =>
            'title,alias,description_short,description_long,cutting_area, ' .
            'cutting_direction,images,document_brochure,storage_style,storage_type,model_series,application_area, ' .
            'saw_type,cutting_option,cut_count,material,material_width,material_height,material_diameter,' .
            'material_square,saw_automation,material_shaping,system_name,type,addons,services,contact,tables,',
        'iconfile' => 'EXT:kasto_products/Resources/Public/Icons/product.svg'
    ],
    'interface' => [
        'showRecordFieldList' =>
            'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, alias, title_skip_cursive, is_used, ' .
            'description_short, description_long, cutting_area, cutting_direction, images, document_brochure, variant' .
            'storage_style, storage_type, model_series, application_area, saw_type, cutting_option, cut_count, ' .
            'material, material_width, material_height, material_diameter, material_square, saw_automation, ' .
            'material_shaping, system_name, type, addons, services, related_references, contact, video_urls, tables, sorting',
        'maxDBListItems' => 10,
        'maxSingleDBListItems' => 20,
    ],
    'palettes' => [
        'general' => [
            'showitem' => 'type, sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, '
        ],
        'titleAndAlias' => [
            'showitem' => 'title, alias, '
        ],
        'titleSkipAndModel' => [
            'showitem' => 'model_series, title_skip_cursive, is_used,  '
        ],
        'applicationAreaAndSawType' => [
            'showitem' => 'application_area, saw_type, '
        ],
        'cuttingOptionsAndCutCount' => [
            'showitem' => 'cutting_option, cut_count, '
        ],
        'applicationAreaAndDirection' => [
            'showitem' => 'cutting_area, cutting_direction, '
        ],
        'materialWidthAndHeight' => [
            'showitem' => 'material_width, material_height, '
        ],
        'materialDiameterAndSquare' => [
            'showitem' => 'material_diameter, material_square, '
        ],
        'sawAutomation' => [
            'showitem' => 'saw_automation,  '
        ],
        'storageStyleAndType' => [
            'showitem' => 'storage_type, storage_style, '
        ],
    ],
    'types' => [
        '1' => [
            'showitem' =>
                '--div--;' . $ll . 'label.sheet.general' . ',--palette--;;general, --palette--;;titleAndAlias, system_name, ' .
                '--palette--;;titleSkipAndModel, ' .
                '--palette--;;applicationAreaAndSawType, ' .
                '--palette--;;cuttingOptionsAndCutCount,  ' .
                '--palette--;;applicationAreaAndDirection, material, ' .
                '--palette--;;materialWidthAndHeight, ' .
                '--palette--;;materialDiameterAndSquare, ' .
                '--palette--;;storageStyleAndType, ' .
                '--palette--;;sawAutomation, description_short, description_long,' .
                '--div--;' . $ll . 'label.sheet.data' . ', material_shaping, tables, ' .
                '--div--;' . $ll . 'label.sheet.media' . ', images, document_brochure, video_urls, ' .
                '--div--;' . $ll . 'label.sheet.addons_services' . ', addons, services, ' .
                '--div--;' . $ll . 'label.sheet.references_contact' . ', contact, related_references, variant, sorting'
               //'--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access, starttime, '.
               //'endtime'
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
                'foreign_table'       => 'tx_kastoproducts_domain_model_product',
                'foreign_table_where' => 'AND tx_kastoproducts_domain_model_product.pid=###CURRENT_PID### AND  ' .
                    ' sys_language_uid IN (-1,0)',
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
        'starttime' => [
            'exclude'   => 1,
            'label'     => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config'    => [
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
                'type'       => 'input',
                'renderType' => 'inputDateTime',
                'eval'       => 'datetime',
                'size'       => 13,
                'checkbox'   => 0,
                'default'    => 0,
                'range'      => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude'   => 1,
            'label'     => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config'    => [
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ],
                'type'       => 'input',
                'renderType' => 'inputDateTime',
                'eval'       => 'datetime',
                'size'       => 13,
                'checkbox'   => 0,
                'default'    => 0,
                'range'      => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'title' => [
            'exclude' => 0,
            'label'   => $ll . 'tx_kastoproducts_domain_model_product.title',
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'alias' => [
            'l10n_mode' => 'exclude',
            'exclude'   => 0,
            'label'     => $ll . 'tx_kastoproducts_domain_model_product.alias',
            'config'    => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'title_skip_cursive' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:!=:' . $types['systemsTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.title_skip_cursive',
            'config'      => [
                'type'    => 'check',
                'default' => 0
            ]
        ],
        'is_used' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => [
                'AND' => [
                    'FIELD:type:!=:' . $types['servicesTypeId'],
                    'FIELD:type:!=:' . $types['accessoriesTypeId'],
                ],
            ],
            'exclude' => 0,
            'label'   => $ll . 'tx_kastoproducts_domain_model_product.is_used',
            'config'  => [
                'type'    => 'check',
                'default' => 0
            ]
        ],
        'description_short' => [
            'exclude' => 0,
            'label'   => $ll . 'tx_kastoproducts_domain_model_product.description_short',
            'config'  => [
                'type' => 'text',
                'cols' => 55,
                'rows' => 1,
                'eval' => 'trim'
            ]
        ],
        'description_long' => [
            'exclude' => 0,
            'label'   => $ll . 'tx_kastoproducts_domain_model_product.description_long',
            'config'  => [
                'type'           => 'text',
                'enableRichtext' => true,
            ]
        ],
        'cutting_area' => [
            'displayCond' => 'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.cutting_area',
            'config'      => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'cutting_direction' => [
            'l10n_mode'   => 'exclude',
            'displayCond' =>  'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.cutting_direction',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'items'               => [
                    [$ll . 'label.please_select', ''],
                    [$ll . 'label.cutdirection_quer', 'cutdirection_quer'],
                    [$ll . 'label.cutdirection_lang', 'cutdirection_lang'],
                ],
            ],
        ],
        'images' => [
            'l10n_mode' => 'exclude',
            'exclude'   => 0,
            'label'     => $ll . 'tx_kastoproducts_domain_model_product.images',
            'config'    => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'images',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' =>
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
                    ],
                    'maxitems' => 99
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
        'document_brochure' => [
            'exclude' => 0,
            'label'   => $ll . 'tx_kastoproducts_domain_model_product.document_brochure',
            'config'  => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'document_brochure',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' =>
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
                    ],
                    'maxitems' => 1
                ]
            ),
        ],
        'variant' => [
            'displayCond' => [
                'AND' => [
                    'FIELD:type:!=:' . $types['servicesTypeId'],
                    'FIELD:type:!=:' . $types['accessoriesTypeId'],
                ],
            ],
            'exclude' => 0,
            'label'   => $ll . 'tx_kastoproducts_domain_model_product.variant',
            'config'  => [
                'type' => 'input',
                'size' => 45,
                'eval' => 'trim'
            ],
        ],
        'storage_style' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['storageSystemsTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.storage_style',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => 'AND tx_kastoproducts_domain_model_attributevalue.attribute=\'storage_style\''.
                    ' AND sys_language_uid IN (-1,0) ',
                'items'               => [
                    [$ll . 'label.please_select', ''],
                ],
                'size'     => 1,
                'maxitems' => 1,
                'eval'     => 'required'
            ],
        ],
        'storage_type' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['storageSystemsTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.storage_type',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => 'AND tx_kastoproducts_domain_model_attributevalue.attribute=\'storage_type\''.
                    ' AND sys_language_uid IN (-1,0) ',
                'items'               => [
                    [$ll . 'label.please_select', ''],
                ],
                'size'     => 1,
                'maxitems' => 1,
                'eval'     => 'required'
            ],
        ],
        'model_series' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.model_series',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => 'AND tx_kastoproducts_domain_model_attributevalue.attribute=\'model_series\''.
                    ' AND sys_language_uid IN (-1,0) ',
                'items'               => [
                    [$ll . 'label.please_select', ''],
                ],
                'size'     => 1,
                'maxitems' => 1,
                'eval'     => 'required'
            ],
        ],
        'application_area' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.application_area',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => 'AND tx_kastoproducts_domain_model_attributevalue.attribute=\'application_area\''.
                    ' AND sys_language_uid IN (-1,0) ',
                'items'               => [
                    [$ll . 'label.please_select', ''],
                ],
                'size'     => 1,
                'maxitems' => 1,
                'eval'     => 'required'
            ],
        ],
        'saw_type' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.saw_type',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => ' AND tx_kastoproducts_domain_model_attributevalue.attribute=\'saw_type\'' .
                    ' AND sys_language_uid IN (-1,0) ',
                'items'               => [
                    [$ll . 'label.please_select', 0],
                ],
                'maxitems'            => 1,
            ],
        ],
        'cutting_option' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.cutting_option',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectCheckBox',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => ' AND tx_kastoproducts_domain_model_attributevalue.attribute=\'cutting_option\''.
                    ' AND sys_language_uid IN (-1,0) ',
            ],
        ],
        'cut_count' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.cut_count',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectCheckBox',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => ' AND tx_kastoproducts_domain_model_attributevalue.attribute=\'cut_count\'' .
                    ' AND sys_language_uid IN (-1,0) ',
            ],
        ],
        'material' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.material',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectCheckBox',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => ' AND tx_kastoproducts_domain_model_attributevalue.attribute=\'material\'' .
                    ' AND sys_language_uid IN (-1,0) ',
                'size'     => 1,
            ],
        ],
        'material_width' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.material_width',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => 'AND tx_kastoproducts_domain_model_attributevalue.attribute=\'material_width\''.
                    ' AND sys_language_uid IN (-1, 0) ',
                'items'               => [
                    [ $ll . 'label.please_select', 0],
                ],
                'size'     => 1,
                'maxitems' => 1,
            ],
        ],
        'material_height' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.material_height',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => ' AND tx_kastoproducts_domain_model_attributevalue.attribute=\'material_height\''.
                    ' AND sys_language_uid IN (-1, 0) ',
                'items'               => [
                    [$ll . 'label.please_select', 0],
                ],
                'size'     => 1,
                'maxitems' => 1,
            ],
        ],
        'material_diameter' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.material_diameter',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => ' AND tx_kastoproducts_domain_model_attributevalue.attribute=\'material_diameter\''.
                    ' AND sys_language_uid IN (-1, 0) ',
                'items'               => [
                    [$ll . 'label.please_select', 0],
                ],
                'size'     => 1,
                'maxitems' => 1,
            ],
        ],
        'material_square' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.material_square',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => ' AND tx_kastoproducts_domain_model_attributevalue.attribute=\'material_square\''.
                    ' AND sys_language_uid IN (-1, 0) ',
                'items'               => [
                    [$ll . 'label.please_select', 0],
                ],
                'size'     => 1,
                'maxitems' => 1,
            ],
        ],
        'saw_automation' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.saw_automation',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectCheckBox',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => ' AND tx_kastoproducts_domain_model_attributevalue.attribute=\'saw_automation\'' .
                    ' AND sys_language_uid IN (-1,0) ',
            ],
        ],
        'material_shaping' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['sawMachinesTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.material_shaping',
            'config'      => [
                'type'          => 'select',
                'renderType'    => 'selectCheckBox',
                'items'         => [
                    [
                        $ll . 'material_shaping.round_full',
                        'round-full',
                        'EXT:kasto_products/Resources/Public/Icons/MaterialShaping/round-full.svg'
                    ],
                    [
                        $ll . 'material_shaping.flat_full_w_h',
                        'flat-full-w-h',
                        'EXT:kasto_products/Resources/Public/Icons/MaterialShaping/flat-full-w-h.svg'
                    ],
                    [
                        $ll . 'material_shaping.square_shaped',
                        'square-shaped',
                        'EXT:kasto_products/Resources/Public/Icons/MaterialShaping/square-shaped.svg'
                    ],
                    [
                        $ll . 'material_shaping.round_tube',
                        'round-tube',
                        'EXT:kasto_products/Resources/Public/Icons/MaterialShaping/round-tube.svg'
                    ],
                    [
                        $ll . 'material_shaping.flat_tube_w_h',
                        'flat-tube-w-h',
                        'EXT:kasto_products/Resources/Public/Icons/MaterialShaping/flat-tube-w-h.svg'
                    ],
                    [
                        $ll . 'material_shaping.square_tube',
                        'square-tube',
                        'EXT:kasto_products/Resources/Public/Icons/MaterialShaping/square-tube.svg'
                    ]
                ],
                /*
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => ' AND tx_kastoproducts_domain_model_attributevalue.attribute=\'material_shaping\'',
                */
            ],
        ],
        'system_name' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:type:=:' . $types['systemsTypeId'],
            'exclude'     => 0,
            'label'       => $ll . 'tx_kastoproducts_domain_model_product.system_name',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_kastoproducts_domain_model_attributevalue',
                'foreign_table_where' => ' AND tx_kastoproducts_domain_model_attributevalue.attribute=\'system_name\'' .
                    ' AND sys_language_uid IN (-1,0) ',
                'items'      => [
                    [$ll . 'label.please_select', 0],
                ],
                'size'     => 1,
                'maxitems' => 1,
            ],
        ],
        'type' => [
            'exclude'   => 0,
            'l10n_mode' => 'exclude',
            'onChange'  => 'reload',
            'label'     => $ll . 'tx_kastoproducts_domain_model_product.type',
            'config'    => [
                'type'          => 'select',
                'renderType'    => 'selectSingle',
                'foreign_table' => 'tx_kastoproducts_domain_model_type',
                'maxitems'      => 1,
                'default'       => 1,
            ],
        ],
        'addons' => [
            'displayCond' => [
                'AND' => [
                    'FIELD:type:!=:' . $types['systemsTypeId'],
                    'FIELD:type:!=:' . $types['accessoriesTypeId'],
                    'FIELD:type:!=:' . $types['servicesTypeId'],
                ],
            ],
            'l10n_mode' => 'exclude',
            'exclude'   => 0,
            'label'     => $ll . 'tx_kastoproducts_domain_model_product.addons',
            'config'    => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_kastoproducts_domain_model_product',
                'foreign_table_where' => 'AND tx_kastoproducts_domain_model_product.type=' . $types['accessoriesTypeId'] .
                    ' AND sys_language_uid IN (-1,0)',
                'MM'                  => 'tx_kastoproducts_product_addons_mm',
                'foreign_sortby'      => 'sorting',
                'multiple'            => false,
                'maxitems'            => 9999,
                'size'                => 10,
                'enableMultiSelectFilterTextfield' => true,
            ],
        ],
        'services' => [
            'displayCond' => [
                'AND' => [
                    'FIELD:type:!=:' . $types['systemsTypeId'],
                    'FIELD:type:!=:' . $types['accessoriesTypeId'],
                    'FIELD:type:!=:' . $types['servicesTypeId'],
                ],
            ],
            'l10n_mode' => 'exclude',
            'exclude'   => 0,
            'label'     => $ll . 'tx_kastoproducts_domain_model_product.services',
            'config'    => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_kastoproducts_domain_model_product',
                'foreign_table_where' => 'AND tx_kastoproducts_domain_model_product.type=' . $types['servicesTypeId'] .
                    ' AND sys_language_uid IN (-1,0)',
                'MM'                  => 'tx_kastoproducts_product_services_mm',
                'foreign_sortby'      => 'sorting',
                'multiple'            => false,
                'maxitems'            => 9999,
                'size'                => 10,
                'enableMultiSelectFilterTextfield' => true,
            ],
        ],
        'related_references' => [
            'exclude'  => 0,
            'label'    => $ll . 'tx_kastoproducts_domain_model_product.related_references',
            'config'   => [
                'type'           => 'inline',
                'foreign_table'  => 'tx_kastoproducts_domain_model_reference',
                'foreign_field'  => 'product',
                'foreign_sortby' => 'sorting',
                'maxitems'       => 9999,
                'appearance'     => [
                    'collapseAll'             => 1,
                    'levelLinksPosition'      => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'useSortable'             => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
        'contact' => [
            'displayCond' => [
                'AND' => [
                    'FIELD:type:!=:' . $types['servicesTypeId'],
                    'FIELD:type:!=:' . $types['accessoriesTypeId'],
                ],
            ],
            'l10n_mode' => 'exclude',
            'exclude'   => 0,
            'label'     => $ll . 'tx_kastoproducts_domain_model_product.contact',
            'config'    => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_kastocontacts_domain_model_contact',
                'foreign_table_where' => 'sys_language_uid IN (-1,0)',
                'maxitems'            => 1,
                'items'               => [
                    [$ll . 'label.please_select', 0],
                ],
            ],
        ],
        'video_urls' => [
            'exclude' => 0,
            'label'   => $ll . 'tx_kastoproducts_domain_model_product.video_urls',
            'config'  => [
                'type'           => 'inline',
                'foreign_table'  => 'tx_kastoproducts_domain_model_url',
                'foreign_field'  => 'product',
                'foreign_sortby' => 'sorting',
                'maxitems'       => 9999,
                'appearance'     => [
                    'collapseAll' => 1,
                ],
            ],
        ],
        'tables' => [
            'displayCond' => [
                'AND' => [
                    'FIELD:type:!=:' . $types['systemsTypeId'],
                    'FIELD:type:!=:' . $types['accessoriesTypeId'],
                    'FIELD:type:!=:' . $types['servicesTypeId'],
                ],
            ],
            'exclude' => 0,
            'label'   => $ll . 'tx_kastoproducts_domain_model_product.tables',
            'config'  => [
                'type'           => 'inline',
                'foreign_table'  => 'tx_kastoproducts_domain_model_table',
                'foreign_field'  => 'product',
                'foreign_sortby' => 'sorting',
                'maxitems'       => 9999,
                'appearance'     => [
                    'collapseAll'             => 1,
                    'levelLinksPosition'      => 'top',
                    'showSynchronizationLink' => 0,
                    'showPossibleLocalizationRecords' => 0,
                    'useSortable'             => 1,
                    'showAllLocalizationLink' => 0
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'sorting'=> [
            'l10n_mode' => 'exclude',
            'config' => [
                'type' => 'passthrough'
            ],
        ]

    ],
];
