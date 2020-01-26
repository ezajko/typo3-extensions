<?php

namespace Dkd\BsbhEvents\Utility;

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

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class AccessHandling
 *
 * Contains helper classes to handle user access.
 *
 * @package Dkd\BsbhEvents\Utility
 */
class AccessHandling
{

    /**
     * Object Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Configuration Manager
     *
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
     */
    protected $configurationManager;

    /**
     * AccessHandling constructor.
     */
    public function __construct()
    {
        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
        $this->configurationManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Configuration\ConfigurationManager::class);
    }


    /**
     * Checks if the currently logged in user has the permission to edit the events
     *
     * @return bool
     */
    public function feUserHasEditPermission($pluginUid, $fieldname)
    {
        $feUserHasEditPermission = false;
        if ($this->userIsLoggedIn()) {
            $userEventCategories = $this->getUserEventCategories($GLOBALS['TSFE']->fe_user->user['uid']);
            $pluginEventCategories = $this->getPluginEventCategories($pluginUid, $fieldname);
            foreach ($userEventCategories as $userEventCategory) {
                if ($pluginEventCategories->contains($userEventCategory)) {
                    $feUserHasEditPermission = true;
                    break;
                }
            }
        }
        return $feUserHasEditPermission;
    }

    /**
     * Checks if fe_user is logged in
     *
     * @return bool
     */
    public function userIsLoggedIn()
    {
        return (!isset($GLOBALS['TSFE']) || !$GLOBALS['TSFE']->loginUser) ? false : true;
    }


    /**
     * Returns all categories set for a given frontend user
     *
     * @param int $userId of the frontend user
     * @return object|\TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getUserEventCategories($userId)
    {
        $categoryRepository = $this->objectManager->get(\TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository::class);
        $userUid = $userId;
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable("sys_category_record_mm");
        $userEventCategoryIds = $queryBuilder
            ->select("uid_local")
            ->from("sys_category_record_mm")
            ->where("uid_foreign=" . $queryBuilder->quote($userUid) . " AND fieldname = 'user_categories'")
            ->execute()
            ->fetchAll();
        $userEventCategoriesCollection = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class);
        if (isset($userEventCategoryIds[0]['uid_local'])) {
            foreach ($userEventCategoryIds as $category) {
                $userEventCategoriesCollection->attach($categoryRepository->findByUid($category['uid_local']));
            }
        }
        return $userEventCategoriesCollection;
    }

    /**
     * Returns all categories set for the currently used frontend plugin
     *
     * @return object|\TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getPluginEventCategories($pluginUid, $fieldname)
    {
        $categoryRepository = $this->objectManager->get(\TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository::class);
        $eventCategories = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class);
        $pluginEventCategories = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable("sys_category_record_mm")
            ->select("uid_local")
            ->from("sys_category_record_mm")
            ->where("uid_foreign= " . $pluginUid . " AND fieldname= '" . $fieldname . "'")
            ->execute()
            ->fetchAll();
        if (isset($pluginEventCategories[0]['uid_local'])) {
            foreach ($pluginEventCategories as $category) {
                $eventCategories->attach($categoryRepository->findByUid($category['uid_local']));
            }
        }
        return $eventCategories;
    }
}
