<?php
namespace Media711\KastoProducts\Persistence;

use TYPO3\CMS\Extbase\Persistence\Generic\Qom\Statement;

/**
 * Class QueryResult
 *
 * TODO: check it if still needed after update to new versions of typo3
 */
class QueryResult extends \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
{
    /**
     * issue in Extbase https://forge.typo3.org/issues/80464
     *
     * Overwrites the original implementation of Extbase
     *
     * When the query contains a $statement the query is regularly executed and the number of results is counted
     * instead of the original implementation which tries to create a custom COUNT(*) query and delivers wrong results.
     *
     * @return int The number of matching objects
     */
    public function count()
    {
        if ($this->numberOfResults === null) {
            if (is_array($this->queryResult)) {
                $this->numberOfResults = count($this->queryResult);
            } else {
                $statement = $this->query->getStatement();
                if ($statement instanceof Statement) {
                    $this->initialize();
                    $this->numberOfResults = count($this->queryResult);
                } else {
                    return parent::count();
                }
            }
        }

        return $this->numberOfResults;
    }
}
