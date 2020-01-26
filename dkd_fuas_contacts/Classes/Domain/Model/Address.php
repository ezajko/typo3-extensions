<?php
namespace Dkd\DkdFuasContacts\Domain\Model;

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

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * The Address domain model
 */
class Address extends \TYPO3\TtAddress\Domain\Model\Address
{
    /**
     * Faculty
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    protected $faculty;

    /**
     * Ffield of expertise
     *
     * @var string
     */
    protected $fieldOfExpertise;

    /**
     * Phone 2
     *
     * @var string
     */
    protected $phone2;

    /**
     * Speaking time
     *
     * @var string
     */
    protected $speakingTime;

    /**
     * Regular courses
     *
     * @var string
     */
    protected $regularCourses;

    /**
     * Quicklinks
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Dkd\DkdFuasContacts\Domain\Model\Link>
     * @lazy
     */
    protected $quicklinks;

    /**
     * Downloads
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @lazy
     */
    protected $downloads;

    /**
     * Categories
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     * @lazy
     */
    protected $categories;

    /**
     * Phone 3
     *
     * @var string
     */
    protected $phone3;

    /**
     * Email 2
     *
     * @var string
     */
    protected $email2;

    /**
     * Email 3
     *
     * @var string
     */
    protected $email3;

    /**
     * Languages
     *
     * @var string
     */
    protected $languages;

    /**
     * npPhone
     *
     * @var boolean
     */
    protected $npPhone;

    /**
     * npPhone2
     *
     * @var boolean
     */
    protected $npPhone2;

    /**
     * npPhone3
     *
     * @var boolean
     */
    protected $npPhone3;

    /**
     * npEmail
     *
     * @var boolean
     */
    protected $npEmail;

    /**
     * npEmail2
     *
     * @var boolean
     */
    protected $npEmail2;

    /**
     * npEmail3
     *
     * @var boolean
     */
    protected $npEmail3;

    /**
     * npMobile
     *
     * @var boolean
     */
    protected $npMobile;

    /**
     * captionPhone
     *
     * @var string
     */
    protected $captionPhone;

    /**
     * captionPhone2
     *
     * @var string
     */
    protected $captionPhone2;

    /**
     * captionPhone3
     *
     * @var string
     */
    protected $captionPhone3;

    /**
     * captionEmail
     *
     * @var string
     */
    protected $captionEmail;

    /**
     * captionEmail2
     *
     * @var string
     */
    protected $captionEmail2;

    /**
     * captionEmail3
     *
     * @var string
     */
    protected $captionEmail3;

    /**
     * captionMobile
     *
     * @var string
     */
    protected $captionMobile;

    /**
     * Content Elements
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Dkd\DkdExtbase\Domain\Model\Content>
     * @lazy
     */
    protected $contentElements;

    /**
     * contactfunction
     *
     * @var \Dkd\DkdFuasContacts\Domain\Model\Contactfunction
     */
    protected $contactfunction;

    /**
     * Xing profile name
     *
     * @var string
     */
    protected $xing;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->downloads = new ObjectStorage();
        $this->quicklinks = new ObjectStorage();
        $this->faculty = new ObjectStorage();
        $this->categories = new ObjectStorage();
        $this->contentElements = new ObjectStorage();
    }

    /**
     * @return string
     */
    public function getFieldOfExpertise()
    {
        return $this->fieldOfExpertise;
    }

    /**
     * @param string $fieldOfExpertise
     */
    public function setFieldOfExpertise($fieldOfExpertise)
    {
        $this->fieldOfExpertise = $fieldOfExpertise;
    }

    /**
     * @return string
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * @param string $phone2
     */
    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;
    }

    /**
     * @return string
     */
    public function getSpeakingTime()
    {
        return $this->speakingTime;
    }

    /**
     * @param string $speakingTime
     */
    public function setSpeakingTime($speakingTime)
    {
        $this->speakingTime = $speakingTime;
    }

    /**
     * @return string
     */
    public function getRegularCourses()
    {
        return $this->regularCourses;
    }

    /**
     * @param string $regularCourses
     */
    public function setRegularCourses($regularCourses)
    {
        $this->regularCourses = $regularCourses;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getFaculty()
    {
        return $this->faculty;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $faculty
     */
    public function setFaculty($faculty)
    {
        $this->faculty = $faculty;
    }

    /**
     * @return ObjectStorage
     */
    public function getQuicklinks()
    {
        return $this->quicklinks;
    }

    /**
     * @param ObjectStorage $quicklinks
     */
    public function setQuicklinks($quicklinks)
    {
        $this->quicklinks = $quicklinks;
    }

    /**
     * @return ObjectStorage
     */
    public function getDownloads()
    {
        return $this->downloads;
    }

    /**
     * @param ObjectStorage $downloads
     */
    public function setDownloads($downloads)
    {
        $this->downloads = $downloads;
    }


    /**
     * Get categories
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Get first category
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\Category
     */
    public function getFirstCategory()
    {
        $categories = $this->getCategories();
        if (!is_null($categories)) {
            $categories->rewind();
            return $categories->current();
        } else {
            return null;
        }
    }

    /**
     * Set categories
     *
     * @param  \TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * Adds a category to this categories.
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
     */
    public function addCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category)
    {
        $this->getCategories()->attach($category);
    }

    /**
     * @return string
     */
    public function getEmail2()
    {
        return $this->email2;
    }

    /**
     * @param string $email2
     */
    public function setEmail2($email2)
    {
        $this->email2 = $email2;
    }

    /**
     * @return string
     */
    public function getEmail3()
    {
        return $this->email3;
    }

    /**
     * @param string $email3
     */
    public function setEmail3($email3)
    {
        $this->email3 = $email3;
    }

    /**
     * @return string
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param string $languages
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }

    /**
     * @return string
     */
    public function getCaptionPhone()
    {
        return $this->captionPhone;
    }

    /**
     * @param string $captionPhone
     */
    public function setCaptionPhone($captionPhone)
    {
        $this->captionPhone = $captionPhone;
    }

    /**
     * @return string
     */
    public function getCaptionPhone2()
    {
        return $this->captionPhone2;
    }

    /**
     * @param string $captionPhone2
     */
    public function setCaptionPhone2($captionPhone2)
    {
        $this->captionPhone2 = $captionPhone2;
    }

    /**
     * @return string
     */
    public function getCaptionPhone3()
    {
        return $this->captionPhone3;
    }

    /**
     * @param string $captionPhone3
     */
    public function setCaptionPhone3($captionPhone3)
    {
        $this->captionPhone3 = $captionPhone3;
    }

    /**
     * @return string
     */
    public function getCaptionEmail()
    {
        return $this->captionEmail;
    }

    /**
     * @param string $captionEmail
     */
    public function setCaptionEmail($captionEmail)
    {
        $this->captionEmail = $captionEmail;
    }

    /**
     * @return string
     */
    public function getCaptionEmail2()
    {
        return $this->captionEmail2;
    }

    /**
     * @param string $captionEmail2
     */
    public function setCaptionEmail2($captionEmail2)
    {
        $this->captionEmail2 = $captionEmail2;
    }

    /**
     * @return string
     */
    public function getCaptionEmail3()
    {
        return $this->captionEmail3;
    }

    /**
     * @param string $captionEmail3
     */
    public function setCaptionEmail3($captionEmail3)
    {
        $this->captionEmail3 = $captionEmail3;
    }

    /**
     * @return string
     */
    public function getCaptionMobile()
    {
        return $this->captionMobile;
    }

    /**
     * @param string $captionMobile
     */
    public function setCaptionMobile($captionMobile)
    {
        $this->captionMobile = $captionMobile;
    }

    /**
     * @return string
     */
    public function getPhone3()
    {
        return $this->phone3;
    }

    /**
     * @param string $phone3
     */
    public function setPhone3($phone3)
    {
        $this->phone3 = $phone3;
    }

    /**
     * @return bool
     */
    public function isNpPhone()
    {
        return $this->npPhone;
    }

    /**
     * @param bool $npPhone
     */
    public function setNpPhone($npPhone)
    {
        $this->npPhone = $npPhone;
    }

    /**
     * @return bool
     */
    public function isNpPhone2()
    {
        return $this->npPhone2;
    }

    /**
     * @param bool $npPhone2
     */
    public function setNpPhone2($npPhone2)
    {
        $this->npPhone2 = $npPhone2;
    }

    /**
     * @return bool
     */
    public function isNpPhone3()
    {
        return $this->npPhone3;
    }

    /**
     * @param bool $npPhone3
     */
    public function setNpPhone3($npPhone3)
    {
        $this->npPhone3 = $npPhone3;
    }

    /**
     * @return bool
     */
    public function isNpEmail()
    {
        return $this->npEmail;
    }

    /**
     * @param bool $npEmail
     */
    public function setNpEmail($npEmail)
    {
        $this->npEmail = $npEmail;
    }

    /**
     * @return bool
     */
    public function isNpEmail2()
    {
        return $this->npEmail2;
    }

    /**
     * @param bool $npEmail2
     */
    public function setNpEmail2($npEmail2)
    {
        $this->npEmail2 = $npEmail2;
    }

    /**
     * @return bool
     */
    public function isNpEmail3()
    {
        return $this->npEmail3;
    }

    /**
     * @param bool $npEmail3
     */
    public function setNpEmail3($npEmail3)
    {
        $this->npEmail3 = $npEmail3;
    }

    /**
     * @return bool
     */
    public function isNpMobile()
    {
        return $this->npMobile;
    }

    /**
     * @param bool $npMobile
     */
    public function setNpMobile($npMobile)
    {
        $this->npMobile = $npMobile;
    }


    /**
     * Get content elements
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getContentElements()
    {
        return $this->contentElements;
    }

    /**
     * Set content element list
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $contentElements content elements
     */
    public function setContentElements($contentElements)
    {
        $this->contentElements = $contentElements;
    }

    /**
     * Adds a content element to the record
     *
     * @param \Dkd\DkdExtbase\Domain\Model\Content $contentElement
     */
    public function addContentElement(\Dkd\DkdExtbase\Domain\Model\Content $contentElement)
    {
        if ($this->getContentElements() === null) {
            $this->contentElements = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        }
        $this->contentElements->attach($contentElement);
    }

    /**
     * Get id list of content elements
     *
     * @return string
     */
    public function getContentElementIdList()
    {
        $idList = [];
        $contentElements = $this->getContentElements();
        if ($contentElements) {
            foreach ($this->getContentElements() as $contentElement) {
                $idList[] = $contentElement->getUid();
            }
        }
        return implode(',', $idList);
    }

    /**
     * @return Contactfunction
     */
    public function getContactfunction()
    {
        return $this->contactfunction;
    }

    /**
     * @param Contactfunction $contactfunction
     */
    public function setContactfunction($contactfunction)
    {
        $this->contactfunction = $contactfunction;
    }

    /**
     * @return string
     */
    public function getXing()
    {
        return $this->xing;
    }

    /**
     * @param string $xing
     */
    public function setXing($xing)
    {
        $this->xing = $xing;
    }
}
