<?php
namespace Media711\KastoProducts\Domain\Model;

/**
 * Url
 */
class Url extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * value
     *
     * @var string
     */
    protected $value = '';
    
    /**
     * Returns the value
     *
     * @return string $value
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Sets the value
     *
     * @param string $value
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
