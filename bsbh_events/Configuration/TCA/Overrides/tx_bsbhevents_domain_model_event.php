<?php

// Add an extra categories selection field to tx_bsbhevents_domain_model_event table
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    'bsbh_events',
    'tx_bsbhevents_domain_model_event',
    // Do not use the default field name ("categories") for pages, tt_content, sys_file_metadata, which is already used
    'event_categories',
    array(
        // Set a custom label
        'label' => 'LLL:EXT:bsbh_events/Resources/Private/Language/locallang_db.xlf:tx_bsbhevents_domain_model_event.event_categories',
        // This field should not be an exclude-field
        'exclude' => false,
        // Override generic configuration, e.g. sort by title rather than by sorting
        'fieldConfiguration' => array(
            'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) ORDER BY sys_category.title ASC',
        ),
        // string (keyword), see TCA reference for details
        'l10n_mode' => 'exclude',
        // list of keywords, see TCA reference for details
        'l10n_display' => 'hideDiff',
    )
);
