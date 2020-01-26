<?php
defined('TYPO3_MODE') or die();

call_user_func(
    function () {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Dkd.DkdFuasContacts',
            'Detail',
            [
                'Address' => 'detail'
            ],
            // non-cacheable actions
            [
                'Address' => ''
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Dkd.DkdFuasContacts',
            'TopDetail',
            [
                'Address' => 'topDetail'
            ],
            // non-cacheable actions
            [
                'Address' => ''
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Dkd.DkdFuasContacts',
            'List',
            [
                'Address' => 'list'
            ],
            // non-cacheable actions
            [
                'Address' => ''
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Dkd.DkdFuasContacts',
            'GetPageTitle',
            [
                'Address' => 'getPageTitle'
            ],
            // non-cacheable actions
            [
                'Address' => ''
            ]
        );
    }
);
