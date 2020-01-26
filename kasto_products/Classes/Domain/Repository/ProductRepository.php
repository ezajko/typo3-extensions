<?php
namespace Media711\KastoProducts\Domain\Repository;

use Doctrine\DBAL\Types\Type;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * The repository for Products
 */
class ProductRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    const TABLE = 'tx_kastoproducts_domain_model_product';

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );

    /**
     * @param string $title
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function searchByTitle(string $title)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false)
                                  ->setLanguageUid(0);

        return $query->matching(
            $query->like('title', $title)
        )->execute();
    }

    /**
     * @param int $type
     * @param int $isUsed
     * @param int $limit
     * @param null $page
     * @return array
     */
    public function findByTypeAndIsUsed(int $type, int $isUsed, int $limit, $page = null)
    {
        $query  = $this->createQuery();
        $limit  = $limit != 0 ? $limit : 12;
        $offset = 0;

        if ($page) {
            $offset = ($page * $limit) + $limit - $limit;
        }

        $query->matching(
            $query->logicalAnd(
                $query->equals('type', $type),
                $query->equals('isUsed', $isUsed)
            )
        );

        $query->setOffset($offset);
        $isLast = $query->setLimit($limit + 1)->count() <= $limit; // here +1 cause check if isLast page
        $query->setLimit($limit);

        return [
            'products' => $query->execute(),
            'isLast'   => $isLast
        ];
    }

    /**
     * @param string $productUidList
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findProductsFromList(string $productUidList)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        return $query->matching(
            $query->in('uid', explode(',', $productUidList))
        )->execute();
    }

    /**
     * main saw machines filter method
     *
     * @param array $filterAttr
     * @param int type
     * @param int $isUsed
     * @return mixed
     */
    public function filterSawMachinesByAttr(array $filterAttr, int $type, int $isUsed, int $limit, $page = null)
    {
        /*
        $queryBuilder = $this->objectManager->get(ConnectionPool::class)->getQueryBuilderForTable(self::TABLE);
        if (!empty($filterAttr[0])) {
            foreach ($filterAttr[0] as $column => $searchValue) {
                $where[] = $queryBuilder->expr()->inSet($column, $queryBuilder->quote(strip_tags($searchValue),\PDO::PARAM_STR), true);
            }
        }
        if (!empty($filterAttr[1])) {
            foreach ($filterAttr[1] as $column => $searchValue) {
                $where[] = $queryBuilder->expr()->eq((string) $column,  (int) $searchValue);
            }
        }
        $where[] = $queryBuilder->expr()->eq('is_used',  (int) $isUsed);

        $queryBuilder->select('*')
                     ->from(self::TABLE)
                     ->where(...$where)
                     ->orderBy('sorting');
        debug($queryBuilder->getSQL());die;
        return $query->statement($queryBuilder->getSQL())->execute();
        */


        $query         = $this->createQuery();
        $constraints[] = $query->equals('isUsed', $isUsed);
        $constraints[] = $query->equals('type', $type);

        if (!empty($filterAttr[0])) {
            foreach ($filterAttr[0] as $column => $searchValue) {
                if ($column == 'cutting_direction') {
                    $constraints[] = $query->equals(
                        GeneralUtility::underscoredToLowerCamelCase($column),
                        $searchValue
                    );
                    continue;
                }

                $constraints[] = $query->contains(
                    GeneralUtility::underscoredToLowerCamelCase($column),
                    (string) $searchValue
                );
            }
        }
        if (!empty($filterAttr[1])) {
            foreach ($filterAttr[1] as $column => $searchValue) {
                $constraints[] = $query->equals(
                    GeneralUtility::underscoredToLowerCamelCase($column),
                    (int) $searchValue
                );
            }
        }

        $limit  = $limit != 0 ? $limit : 12;
        $offset = 0;

        if ($page) {
            $offset = ($page * $limit) + $limit - $limit;
        }

        $query->matching(
            $query->logicalAnd($constraints)
        );

        $query->setOffset($offset);
        $isLast = $query->setLimit($limit + 1)->count() <= $limit; // here +1 cause check if isLast page
        $query->setLimit($limit);

        return [
            'products' => $query->execute(),
            'isLast'   => $isLast
        ];
    }
}
