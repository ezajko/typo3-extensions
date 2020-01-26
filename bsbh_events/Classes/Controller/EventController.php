<?php
namespace Dkd\BsbhEvents\Controller;

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
use TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter;
use HTMLPurifier;
use Parsedown;

/**
 * EventController
 */
class EventController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * eventRepository
     *
     * @var \Dkd\BsbhEvents\Domain\Repository\EventRepository
     * @inject
     */
    protected $eventRepository = null;

    /**
     * access Handling Utility Class
     *
     * @var \Dkd\BsbhEvents\Utility\AccessHandling
     * @inject
     */
    protected $accessHandling;

    /**
     * Object Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Logging
     * @var \TYPO3\CMS\Core\Log\Logger
     */
    protected $logger;
    /**
     * Configuration Manager
     *
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
     * @inject
     */
    protected $configurationManager;

    /**
     * use initializeObject to set default querySettings for this repository.
     */
    public function initializeObject()
    {
        $this->logger = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Log\LogManager::class)
        ->getLogger(__CLASS__);

        /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');

        // don't add the pid constraint
        $querySettings->setRespectStoragePage(false);
        try {
            $this->setDefaultQuerySettings($querySettings);
        } catch (Exception $e) {
            $this->logger->info("Could not set default query settings", $e);
        } finally {
            return;
        }
    }


    /**
     * action list
     *
     * the list action finds events by categories set in plugin.
     * Without parameters, one time events are shown.
     * If parameter "tx_bsbhevents_show[event-type]=recurring is set, recurring events are shown.
     *
     * @return void
     */
    public function listAction()
    {
        $filterEventsByPluginCategory = (bool)!$this->settings['showAllCategories'];

        if ($this->request->hasArgument('event-type') && $this->request->getArgument('event-type') == 'recurring') {
            $events = $this->eventRepository->findRecurringEvents($filterEventsByPluginCategory);
            $this->view->assign('showing-recurring-events', true);
        } else {
            $events = $this->eventRepository->findOneTimeEvents($filterEventsByPluginCategory);
            $this->view->assign('showing-one-time-events', true);
        }

        $this->view->assign('events', $events);
        $this->view->assign('pluginEventCategories', $this->frontEndUserHasEditPermission());
        $this->view->assign('feUserHasEditPermission', $this->frontEndUserHasEditPermission());
    }

    /**
     * renderMarkdown action
     *
     * This action returns a given input (parameter-name is "input") as markdown.
     * It can be used in AJAX calls to get the HTML representation of a markdown string input.
     *
     * @return string
     */
    public function renderMarkdownAction()
    {
        if (isset($_REQUEST['markdown'])) {
            $markdownConverter = GeneralUtility::makeInstance(\Dkd\BsbhEvents\Utility\Markdown::class);
            $output = $markdownConverter->parse(urldecode($_REQUEST['markdown']));
            return json_encode(["result"=>$output]);
        }
        return json_encode('');
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        // we have to assign an empty event here to load default values for fields from model.
        $this->view->assign('event', GeneralUtility::makeInstance(\Dkd\BsbhEvents\Domain\Model\Event::class));

        $this->view->assign('feUserHasEditPermission', $this->frontEndUserHasEditPermission());
    }

    /**
     * initialize create action
     *
     * @param void
     */
    public function initializeCreateAction()
    {
        $this->setMappingConfiguration('newEvent');
    }

    /**
     * initialize update action
     *
     * @param void
     */
    public function initializeUpdateAction()
    {
        $this->setMappingConfiguration('event');
    }

    /**
     * action create
     *
     * @param \Dkd\BsbhEvents\Domain\Model\Event $newEvent
     * @return void
     */
    public function createAction(\Dkd\BsbhEvents\Domain\Model\Event $newEvent)
    {
        if ($this->frontEndUserHasEditPermission()) {
            $newEvent->setEventCategories($this->getPluginEventCategories());
            $this->eventRepository->add($newEvent);
            $this->redirect('list');
        }
    }

    /**
     * action edit
     *
     * @param \Dkd\BsbhEvents\Domain\Model\Event $event
     * @ignorevalidation $event
     * @return void
     */
    public function editAction(\Dkd\BsbhEvents\Domain\Model\Event $event)
    {
        if ($this->frontEndUserHasEditPermission()) {
            $this->view->assign('event', $event);
        } else {
            $this->view->assign('feUserHasEditPermission', false);
        }
    }

    /**
     * action update
     *
     * @param \Dkd\BsbhEvents\Domain\Model\Event $event
     * @return void
     */
    public function updateAction(\Dkd\BsbhEvents\Domain\Model\Event $event)
    {
        if ($this->frontEndUserHasEditPermission()) {
            $this->eventRepository->update($event);
            $this->redirect('list');
        }
    }

    /**
     * action delete
     *
     * @param \Dkd\BsbhEvents\Domain\Model\Event $event
     * @return void
     */
    public function deleteAction(\Dkd\BsbhEvents\Domain\Model\Event $event)
    {
        if ($this->frontEndUserHasEditPermission()) {
            $event->setHidden(true);
            $this->eventRepository->update($event);
            // arguments from previous request are kept to redirect the user to the correct listing.
            $this->redirect('list', null, null, $this->request->getArguments());
        }
    }

    /**
     * Sets the mapping Configuration for date and time inputs.
     *
     * @param string $type (example: 'event', 'newEvent')
     */
    protected function setMappingConfiguration($type)
    {
        $mappingConfiguration = $this->arguments->getArgument($type)->getPropertyMappingConfiguration();

        // set date format for event start date field
        $mappingConfiguration->forProperty('eventStartDate')->setTypeConverterOption(
            DateTimeConverter::class,
            DateTimeConverter::CONFIGURATION_DATE_FORMAT,
            'Y-m-d'
        );
        // set time format for event start time field
        $mappingConfiguration->forProperty('eventStartTime')->setTypeConverterOption(
            DateTimeConverter::class,
            DateTimeConverter::CONFIGURATION_DATE_FORMAT,
            'H:i'
        );

        // set date format for event end date field
        $mappingConfiguration->forProperty('eventEndDate')->setTypeConverterOption(
            DateTimeConverter::class,
            DateTimeConverter::CONFIGURATION_DATE_FORMAT,
            'Y-m-d'
        );
        // set time format for event end time field
        $mappingConfiguration->forProperty('eventEndTime')->setTypeConverterOption(
            DateTimeConverter::class,
            DateTimeConverter::CONFIGURATION_DATE_FORMAT,
            'H:i'
        );
    }

    protected function frontEndUserHasEditPermission()
    {
        $pluginUid = $this->configurationManager->getContentObject()->data['uid'];
        return $this->accessHandling->feUserHasEditPermission($pluginUid, "event_categories");
    }

    protected function getPluginEventCategories()
    {
        $pluginUid = $this->configurationManager->getContentObject()->data['uid'];
        return $this->accessHandling->getPluginEventCategories($pluginUid, "event_categories");
    }
}
