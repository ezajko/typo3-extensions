<?php
return [
    'ctrl'      => [
        'title'                    => 'LLL:EXT:bsbh_events/Resources/Private/Language/locallang_db.xlf:tx_bsbhevents_domain_model_event',
        'label'                    => 'title',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'cruser_id'                => 'cruser_id',
        'sortby'                   => 'sorting',
        'versioningWS'             => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete'                   => 'deleted',
        'enablecolumns'            => [
            'disabled'  => 'hidden',
            'starttime' => 'starttime',
            'endtime'   => 'endtime',
        ],
        'searchFields'             => 'title,event_start,event_end,is_repeating_event, is_full_day, content,location,recurrence_rule,event_categories',
        'iconfile'                 => 'EXT:bsbh_events/Resources/Public/Icons/tx_bsbhevents_domain_model_event.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, event_start, event_end, is_repeating_event, is_full_day, content, location, recurrence_rule, event_categories',
    ],
    'types'     => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, event_start, event_end, is_repeating_event, is_full_day, content, location, recurrence_rule, event_categories, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns'   => [
        'sys_language_uid' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config'  => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'special'    => 'languages',
                'items'      => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default'    => 0,
            ],
        ],
        'l10n_parent'      => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => true,
            'label'       => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'items'               => [
                    ['', 0],
                ],
                'foreign_table'       => 'tx_bsbhevents_domain_model_event',
                'foreign_table_where' => 'AND tx_bsbhevents_domain_model_event.pid=###CURRENT_PID### AND tx_bsbhevents_domain_model_event.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource'  => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label'      => [
            'label'  => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max'  => 255,
            ],
        ],
        'hidden'           => [
            'exclude' => true,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config'  => [
                'type'  => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
        'starttime'        => [
            'exclude'   => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label'     => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config'    => [
                'type'    => 'input',
                'size'    => 13,
                'eval'    => 'datetime',
                'default' => time(),
            ],
        ],
        'endtime'          => [
            'exclude'   => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label'     => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config'    => [
                'type'    => 'input',
                'size'    => 13,
                'eval'    => 'datetime',
                'default' => 0,
                'range'   => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
            ],
        ],

        'title'              => [
            'exclude' => true,
            'label'   => 'LLL:EXT:bsbh_events/Resources/Private/Language/locallang_db.xlf:tx_bsbhevents_domain_model_event.title',
            'config'  => [
                'type'     => 'input',
                'size'     => 255,
                'eval'     => 'trim',
                'required' => true
            ],
        ],
        'event_start'        => [
            'exclude' => true,
            'label'   => 'LLL:EXT:bsbh_events/Resources/Private/Language/locallang_db.xlf:tx_bsbhevents_domain_model_event.event_start',
            'config'  => [
                'type'    => 'input',
                'size'    => 10,
                'eval'    => 'datetime',
                'default' => time()
            ],
        ],
        'event_end'          => [
            'exclude' => true,
            'label'   => 'LLL:EXT:bsbh_events/Resources/Private/Language/locallang_db.xlf:tx_bsbhevents_domain_model_event.event_end',
            'config'  => [
                'type'    => 'input',
                'size'    => 10,
                'eval'    => 'datetime',
                'default' => 0
            ],
        ],
        'is_repeating_event' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:bsbh_events/Resources/Private/Language/locallang_db.xlf:tx_bsbhevents_domain_model_event.is_repeating_event',
            'config'  => [
                'type'    => 'check',
                'items'   => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
                'default' => 0,
            ]
        ],
        'is_full_day'        => [
            'exclude' => true,
            'label'   => 'LLL:EXT:bsbh_events/Resources/Private/Language/locallang_db.xlf:tx_bsbhevents_domain_model_event.is_full_day',
            'config'  => [
                'type'    => 'check',
                'items'   => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
                'default' => 0,
            ]
        ],
        'content'            => [
            'exclude' => true,
            'label'   => 'LLL:EXT:bsbh_events/Resources/Private/Language/locallang_db.xlf:tx_bsbhevents_domain_model_event.content',
            'config'  => [
                'type'     => 'text',
                'eval'     => 'trim',
                'required' => true
            ],
        ],
        'location'           => [
            'exclude' => true,
            'label'   => 'LLL:EXT:bsbh_events/Resources/Private/Language/locallang_db.xlf:tx_bsbhevents_domain_model_event.location',
            'config'  => [
                'type'     => 'text',
                'eval'     => 'trim',
                'required' => true
            ],
        ],
        'recurrence_rule'    => [
            'exclude' => true,
            'label'   => 'LLL:EXT:bsbh_events/Resources/Private/Language/locallang_db.xlf:tx_bsbhevents_domain_model_event.recurrence_rule',
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
    ],
];
