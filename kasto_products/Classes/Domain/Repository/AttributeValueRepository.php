<?php
namespace Media711\KastoProducts\Domain\Repository;

/**
 * The repository for Properies
 */
class AttributeValueRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );

    /**
     * @param $value
     * @param $attr
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findParent($value, $attr)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        return $query->matching(
            $query->logicalAnd(
                $query->like('value', $value),
                $query->like('attribute', $attr),
                $query->like('sys_language_uid', 0)
            )
        )->execute();
    }

    /**
     * search records everywhere
     *
     * @param string $title
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function searchByValue(string $title)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        return $query->matching(
            $query->like('value', $title)
        )->execute();
    }

    /**
     * @param string $value
     * @param string $attrName
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function searchByValueAndAttr(string $value, string $attrName)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        return $query->matching(
            $query->logicalAnd(
                $query->like('value', $value),
                $query->like('attribute', $attrName)
            )
        )->execute();
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\Type|int
     * @param string $value
     * @param string $attrName
     * @return \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    public function searchOneByTypeAndValueAndAttr($type, $value, $attrName)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        return reset($query->matching(
            $query->logicalAnd([
                $query->like('type', $type),
                $query->like('value', $value),
                $query->like('attribute', $attrName)
            ])
        )->setLimit(1)->execute()->toArray());
    }

    /**
     * @param $attr
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByAttribute($attr)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        return $query->matching(
            $query->like('attribute', $attr)
        )->execute();
    }

    /**
     * @param array$list
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAttributesFromList(array $list)
    {
        if (!empty(array_filter($list))) {
            $query = $this->createQuery();
            $query->getQuerySettings()->setRespectStoragePage(false);

            return $query->matching(
                $query->in(($GLOBALS['TSFE']->sys_language_uid == 0) ? 'uid' : 'l10n_parent', $list)
            )->execute();
        }
    }
}
