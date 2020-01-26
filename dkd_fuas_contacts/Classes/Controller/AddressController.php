<?php
namespace Dkd\DkdFuasContacts\Controller;

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

use Dkd\DkdFuasContacts\Domain\Model\Address;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * The AddressController
 */
class AddressController extends ActionController
{
    /**
     * addressRepository
     *
     * @var \Dkd\DkdFuasContacts\Domain\Repository\AddressRepository
     * @inject
     */
    protected $addressRepository = null;

    /**
     * List action
     */
    public function listAction()
    {
        if ($this->settings['filterUids']) {
            $filterUids = GeneralUtility::trimExplode(',', $this->settings['filterUids']);
            foreach ($filterUids as $filterUid) {
                if ($address = $this->addressRepository->findByUid($filterUid)) {
                    $addresses[] = $address;
                }
            }
        } elseif ($this->settings['filterCategories']) {
            $addresses = $this->addressRepository->findByCategoriesOrFaculty(
                GeneralUtility::trimExplode(',', $this->settings['filterCategories'])
            );
        } else {
            $addresses = [];
        }
        $this->view->assign('addresses', $addresses);
    }

    /**
     * Detail action
     */
    public function detailAction()
    {
        if ($this->settings['addressUid']) {
            $addressId = intval($this->settings['addressUid']);
            $address = $this->addressRepository->findByUid($addressId);
        } else {
            $arguments = $this->request->getArguments();
            $addressId = intval($arguments['address']);
            $address = $this->addressRepository->findByUid($addressId);
        }
        if (!$address) {
            $GLOBALS['TSFE']->pageNotFoundAndExit('No content found.');
            return;
        }
        $this->view->assign('address', $address);
    }

    /**
     * Top detail action
     */
    public function topDetailAction()
    {
        if ($this->settings['addressUid']) {
            $addressId = intval($this->settings['addressUid']);
            $address = $this->addressRepository->findByUid($addressId);
        } else {
            $arguments = GeneralUtility::_GP('tx_dkdfuascontacts_detail');
            $addressId = intval($arguments['address']);
            $address = $this->addressRepository->findByUid($addressId);
        }

        $this->view->assign('address', $address);
    }

    /**
     * get page title action
     *
     * @return string
     */
    public function getPageTitleAction()
    {
        $arguments = GeneralUtility::_GP('tx_dkdfuascontacts_detail');
        $addressId = intval($arguments['address']);
        /** @var Address $address */
        $address = $this->addressRepository->findByUid($addressId);
        return $address ? $address->getTitle() . ' ' . $address->getFirstName() . ' ' . $address->getLastName() : '';
    }
}
