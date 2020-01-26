<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 *
 * (c) 2019 Tarang Patel <tarang.patel@dkd.de>, dkd Internet Service GmbH
 */

defined('TYPO3_MODE') || die('Access denied.');


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Dkd.BsbhEvents',
    'Show',
    [
        'Event' => 'list, new, create, edit, update, delete, renderMarkdown'
    ],
    // non-cacheable actions
    [
        'Event' => 'list, renderMarkdown, new, edit, create, update, delete'
    ]
);

// wizards
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    show {
                        iconIdentifier = content-table
                        title = LLL:EXT:bsbh_events/Resources/Private/Language/locallang.xlf:tx_bsbhevents_plugin_name
                        description = LLL:EXT:bsbh_events/Resources/Private/Language/locallang.xlf:tx_bsbhevents_plugin_description
                        tt_content_defValues {
                            CType = list
                            list_type = bsbhevents_show
                        }
                    }
                }
                show = *
            }
       }'
);
