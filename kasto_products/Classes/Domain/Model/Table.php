<?php
namespace Media711\KastoProducts\Domain\Model;

/**
 * Table
 */
class Table extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * header
     *
     * @var string
     */
    protected $header = '';
    
    /**
     * structure
     *
     * @var string
     */
    protected $structure = '';
    
    /**
     * Returns the header
     *
     * @return string $header
     */
    public function getHeader()
    {
        return $this->header;
    }
    
    /**
     * Sets the header
     *
     * @param string $header
     * @return void
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }
    
    /**
     * Returns the structure
     *
     * @return string $structure
     */
    public function getStructure()
    {
        return $this->structure;
    }
    
    /**
     * Sets the structure
     *
     * @param string $structure
     * @return void
     */
    public function setStructure($structure)
    {
        $this->structure = $structure;
    }
}
