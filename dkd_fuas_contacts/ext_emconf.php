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
 */

/**
 * ext_emconf file for dkd_fuas_contacts
 *
 * @package    TYPO3
 * @subpackage dkd_fuas_contacts
 * @author     Tarang Patel <tarang.patel@dkd.de>
 */

$EM_CONF[$_EXTKEY] = array(
    'title' => 'dkd FUAS Contacts',
    'description' => 'Extended functions for tt_address',
    'category' => 'misc',
    'author' => 'Tarang Patel',
    'author_email' => 'tarang.patel@dkd.de',
    'state' => 'beta',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'author_company' => 'dkd Internet Service GmbH',
    'version' => '1.0.0',
    'constraints' => array(
        'depends' => array(
            'tt_address' => '3.2.0-3.2.99'
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        )
    )
);
