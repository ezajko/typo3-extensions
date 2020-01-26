<?php
namespace Media711\KastoProducts\Domain\Repository;

/**
 * The repository for Types
 */
class TypeRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );

    /**
     *
     * @param string $typeTitle
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function searchByTitle(string $typeTitle)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false)
                                  ->setLanguageUid(0);

        return $query->matching(
            $query->like('title', $typeTitle)
        )->execute();
    }
}
