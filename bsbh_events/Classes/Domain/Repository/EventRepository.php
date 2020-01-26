<?php

namespace Dkd\BsbhEvents\Domain\Repository;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class EventRepository
 * @package Dkd\BsbhEvents\Domain\Repository
 */
class EventRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
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
     * Helper class for user access handling
     *
     * @var \Dkd\BsbhEvents\Utility\AccessHandling
     * @inject
     */
    protected $accessHandling;

    /**
     * use initializeObject to set default querySettings for this repository.
     */
    public function initializeObject()
    {
        $this->configurationManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
        /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');

        // don't add the pid constraint
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);

        $this->setDefaultOrderings(['eventStart' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING]);
    }


    /**
     * returns all one time events with category matching the category of the plugin.
     *
     * @param bool $filterByPluginCategories
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findOneTimeEvents($filterByPluginCategories = true)
    {
        $constraints = [];
        $query = $this->createQuery();
        $constraints[] = $query->equals('is_repeating_event', false);
        if ($filterByPluginCategories) {
            $constraints[] = $query->contains('eventCategories', $this->getPluginEventCategories());
        }
        $constraints[] = $query->greaterThanOrEqual('eventStart', strtotime("midnight", time()));
        $query->matching(
            $query->logicalAnd($constraints)
        );

        return $query->execute();
    }

    /**
     * Fetches and returns  all event categories which are selected in the current plugin
     *
     * @return object|\TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    protected function getPluginEventCategories()
    {
        $contentObject = $this->configurationManager->getContentObject();
        $pluginUid = $contentObject->data['uid'];

        return $this->accessHandling->getPluginEventCategories($pluginUid, "event_categories");
    }

    /**
     * returns all recurring events with category matching the category of the plugin.
     *
     * @param bool $filterByPluginCategories
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findRecurringEvents($filterByPluginCategories = true)
    {
        $query = $this->createQuery();
        $constraints[] = $query->equals('is_repeating_event', true);
        if ($filterByPluginCategories) {
            $constraints[] = $query->contains('eventCategories', $this->getPluginEventCategories());
        }
        $query->matching(
            $query->logicalAnd($constraints)
        );

        $query->setOrderings(["sorting" => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING]);

        return $query->execute();
    }
}
