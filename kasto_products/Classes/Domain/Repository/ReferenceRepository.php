<?php
namespace Media711\KastoProducts\Domain\Repository;

/**
 * The repository for References
 */
class ReferenceRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );
}
