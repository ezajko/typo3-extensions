<?php
namespace Media711\KastoProducts\Domain\Repository;

/**
 * The repository for Urls
 */
class UrlRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );
}
