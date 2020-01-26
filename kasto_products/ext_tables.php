<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// ========================================
// Add plugin registration
// ========================================

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Media711.' . $_EXTKEY,
    'Pi1',
    'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xlf:be_plugin.title'
);

// ========================================
// Add Static TypoScript file configuration
// ========================================

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    $_EXTKEY,
    'Configuration/TypoScript',
    'Products'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_kastoproducts_domain_model_product',
    'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh_tx_kastoproducts_domain_model_product.xlf'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_kastoproducts_domain_model_product');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_kastoproducts_domain_model_type');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_kastoproducts_domain_model_url');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_kastoproducts_domain_model_table');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
    'tx_kastoproducts_domain_model_attributevalue'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
    'tx_kastoproducts_domain_model_reference'
);

// ========================================
// Add flexform
// ========================================

$pluginSignature = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToLowerCamelCase($_EXTKEY) . '_pi1');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature]     = 'pi_flexform';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/products_pi1_flexform.xml'
);
