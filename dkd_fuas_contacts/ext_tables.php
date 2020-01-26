<?php
defined('TYPO3_MODE') or die();

call_user_func(
    function () {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Dkd.DkdFuasContacts',
            'Detail',
            'Addresses: Detail'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Dkd.DkdFuasContacts',
            'TopDetail',
            'Addresses: TopDetail'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Dkd.DkdFuasContacts',
            'List',
            'Addresses: List'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('dkd_fuas_contacts', 'Configuration/TypoScript', 'FUAS Contacts');

        $pluginSignature = str_replace('_', '', 'dkd_fuas_contacts') . '_list';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
            $pluginSignature,
            'FILE:EXT:dkd_fuas_contacts/Configuration/FlexForms/List.xml'
        );

        $pluginSignature = str_replace('_', '', 'dkd_fuas_contacts') . '_detail';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
            $pluginSignature,
            'FILE:EXT:dkd_fuas_contacts/Configuration/FlexForms/Detail.xml'
        );

        $pluginSignature = str_replace('_', '', 'dkd_fuas_contacts') . '_topdetail';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
            $pluginSignature,
            'FILE:EXT:dkd_fuas_contacts/Configuration/FlexForms/Detail.xml'
        );
    }
);
