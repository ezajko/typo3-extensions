<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Media711.' . $_EXTKEY,
    'Pi1',
    [
        'Product' => 'list, detail, tabs, ajaxLoadMore, ajaxSawMachinesFilter, pdf',
    ],
    // non-cacheable actions
    [
        'Product' => 'list, detail, ajaxLoadMore, ajaxSawMachinesFilter, pdf',
    ]
);

// ========================================
// PageRender hook for adding custom js file
// =======================================

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-postProcess'][$_EXTKEY]
    = 'Media711\\KastoProducts\\Hook\\AddTableWizardJsHook->postRender';
