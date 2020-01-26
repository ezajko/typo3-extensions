<?php
namespace Dkd\DkdFuasContacts\Domain\Repository;

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

use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * The repository for the domain model Address
 */
class AddressRepository extends \TYPO3\TtAddress\Domain\Repository\AddressRepository
{
    protected $defaultOrderings = array(
        'lastName' => QueryInterface::ORDER_ASCENDING,
        'firstName' => QueryInterface::ORDER_DESCENDING
    );

    /**
     * @param $uids
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByUids($uids)
    {
        $query = $this->createQuery();
        $query->matching($query->in('uid', $uids));

        return $query->execute();
    }

    /**
     * @param $faculty
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByFaculty($faculty)
    {
        $query = $this->createQuery();
        $query->matching($query->contains('faculty', $faculty));
        return $query->execute();
    }

    /**
     * @param $categories
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByCategories($categories)
    {
        $query = $this->createQuery();
        if (!empty($categories)) {
            $or = [];
            foreach ($categories as $category) {
                $or[] = $query->contains('categories', $category);
            }
            if (count($or) == 1) {
                $query->matching(array_shift($or));
            } elseif (count($or) > 1) {
                $query->matching($query->logicalOr($or));
            }
        }
        return $query->execute();
    }

    /**
     * @param $categories
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByCategoriesOrFaculty($categories)
    {
        $query = $this->createQuery();
        if (!empty($categories)) {
            $or = [];
            foreach ($categories as $category) {
                $or[] = $query->contains('categories', $category);
                $or[] = $query->contains('faculty', $category);
            }
            if (count($or) == 1) {
                $query->matching(array_shift($or));
            } elseif (count($or) > 1) {
                $query->matching($query->logicalOr($or));
            }
        }
        return $query->execute();
    }
}
