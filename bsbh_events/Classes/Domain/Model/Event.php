<?php

namespace Dkd\BsbhEvents\Domain\Model;

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

/**
 *  Model for an Event
 */
class Event extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * hidden
     *
     * @var bool
     */
    protected $hidden = false;

    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * start of the event
     *
     * @var \DateTime
     */
    protected $eventStart = null;

    /**
     * start date of the event
     *
     * @var \DateTime
     */
    protected $eventStartDate = null;

    /**
     * start time of the event
     *
     * @var \DateTime
     */
    protected $eventStartTime = null;

    /**
     * end of the event
     *
     * @var \DateTime
     */
    protected $eventEnd = null;

    /**
     * end date of the event
     *
     * @var \DateTime
     */
    protected $eventEndDate = null;

    /**
     * end time of the event
     *
     * @var \DateTime
     */
    protected $eventEndTime = null;

    /**
     * is this a repeating event?
     *
     * @var bool
     */
    protected $isRepeatingEvent = false;

    /**
     * is this a full day event?
     *
     * @var bool
     */
    protected $isFullDay = true;

    /**
     * the description text of the event (markdown)
     *
     * @var string
     */
    protected $content = '';

    /**
     * location of the event
     *
     * @var string
     */
    protected $location = '';

    /**
     * recurrenceRule
     *
     * This field contains user-generated (plain text) information about the repeating interval of the event.
     *
     * @var string
     */
    protected $recurrenceRule = '';

    /**
     * Category of the event (uses sys_categories)
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    protected $eventCategories = null;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        // set initial values to current DateTime
        $this->setEventStart(new \DateTime());
    }

    /**
     * Getshidden flag
     *
     * @return bool
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * Sets hidden flag
     *
     * @param bool $hidden
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * returns isFulDay Flag
     *
     * @return bool
     */
    public function getIsFullDay()
    {
        return $this->isFullDay;
    }

    /**
     * sets isFullDayFlag
     *
     * @param bool $isFullDay
     */
    public function setIsFullDay($isFullDay)
    {
        $this->isFullDay = $isFullDay;
    }

    /**
     * gets eventCategories
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getEventCategories()
    {
        return $this->eventCategories;
    }

    /**
     * sets eventCategories
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $eventCategories
     */
    public function setEventCategories($eventCategories)
    {
        $this->eventCategories = $eventCategories;
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the eventStart
     *
     * @return \DateTime $eventStart
     */
    public function getEventStart()
    {
        return $this->eventStart;
    }

    /**
     * Sets the eventStart
     *
     * @param \DateTime $eventStart
     * @return void
     */
    public function setEventStart(\DateTime $eventStart)
    {
        $this->eventStart = $eventStart;
    }

    /**
     * Sets the date of $this->eventStart
     *
     * @param \DateTime|null $date
     */
    public function setEventStartDate(\DateTime $date = null)
    {
        if ($this->eventStart == null) {
            $this->eventStart = new \DateTime;
        }
        if ($date !== null) {
            $this->eventStart->setDate($date->format("Y"), $date->format("m"), $date->format("d"));
        }
    }

    /**
     * Sets the time of $this->eventStart
     *
     * @param \DateTime|null $time
     */
    public function setEventStartTime(\DateTime $time = null)
    {
        if ($this->eventStart == null) {
            $this->eventStart = new \DateTime;
        }
        if ($time !== null) {
            $this->eventStart->setTime($time->format("H"), $time->format("i"), $time->format("s"));
        }
    }

    /**
     * Gets event eventStartDate
     *
     * @return \DateTime
     */
    public function getEventStartDate()
    {
        return $this->eventStart;
    }

    public function getEventStartTime()
    {
        return $this->eventStart;
    }

    /**
     * Returns the eventEnd
     *
     * @return \DateTime $eventEnd
     */
    public function getEventEnd()
    {
        return $this->eventEnd;
    }

    /**
     * Sets the eventEnd
     *
     * @param \DateTime $eventEnd
     * @return void
     */
    public function setEventEnd(\DateTime $eventEnd)
    {
        $this->eventEnd = $eventEnd;
    }

    /**
     * Sets the date of $this->eventEnd
     *
     * @param \DateTime|null $date
     */
    public function setEventEndDate(\DateTime $date = null)
    {
        if ($this->eventEnd == null) {
            $this->eventEnd = new \DateTime;
        }

        if ($date !== null) {
            $this->eventEnd->setDate($date->format("Y"), $date->format("m"), $date->format("d"));
        } else {
            $this->eventEnd = null;
        }
    }

    /**
     * Sets the time of $this->eventEnd
     *
     * @param \DateTime|null $time
     */
    public function setEventEndTime(\DateTime $time = null)
    {
        if ($time !== null && $this->eventEnd !== null) {
            $this->eventEnd->setTime($time->format("H"), $time->format("i"), $time->format("s"));
        } else if ($this->eventEnd == null) {
            $this->eventEnd = null;
        } else {
            $this->eventEnd->setTime(0, 0, 0);
        }
    }

    /**
     * Gets eventEndDate
     *
     * @return \DateTime
     */
    public function getEventEndDate()
    {
        return $this->eventEnd;
    }

    /**
     * Gets event end time
     *
     * @return \DateTime
     */
    public function getEventEndTime()
    {
        return $this->eventEnd;
    }

    /**
     * Returns the isRepeatingEvent
     *
     * @return bool $isRepeatingEvent
     */
    public function getIsRepeatingEvent()
    {
        return $this->isRepeatingEvent;
    }

    /**
     * Sets the isRepeatingEvent
     *
     * @param bool $isRepeatingEvent
     * @return void
     */
    public function setIsRepeatingEvent($isRepeatingEvent)
    {
        $this->isRepeatingEvent = $isRepeatingEvent;
    }

    /**
     * Returns the boolean state of isRepeatingEvent
     *
     * @return bool
     */
    public function isIsRepeatingEvent()
    {
        return $this->isRepeatingEvent;
    }

    /**
     * Returns the content
     *
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the content
     *
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Returns the location
     *
     * @return string $location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the location
     *
     * @param string $location
     * @return void
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * Returns the recurrenceRule
     *
     * @return string $recurrenceRule
     */
    public function getRecurrenceRule()
    {
        return $this->recurrenceRule;
    }

    /**
     * Sets the recurrenceRule
     *
     * @param string $recurrenceRule
     * @return void
     */
    public function setRecurrenceRule($recurrenceRule)
    {
        $this->recurrenceRule = $recurrenceRule;
    }
}
