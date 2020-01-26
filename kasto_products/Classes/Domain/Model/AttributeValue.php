<?php
namespace Media711\KastoProducts\Domain\Model;

/**
 * Propery
 */
class AttributeValue extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * value
     *
     * @var string
     */
    protected $value = '';
    
    /**
     * attribute
     *
     * @var string
     */
    protected $attribute = '';
    
    /**
     * type
     *
     * @var \Media711\KastoProducts\Domain\Model\Type
     */
    protected $type = null;

    /**
     * @var int
     */
    protected $l10nParent;
    
    /**
     * Returns the value
     *
     * @return string value
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
    
    /**
     * Returns the type
     *
     * @return \Media711\KastoProducts\Domain\Model\Type $type
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Sets the type
     *
     * @param \Media711\KastoProducts\Domain\Model\Type $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }
    
    /**
     * Returns the attribute
     *
     * @return string $attribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }
    
    /**
     * Sets the attribute
     *
     * @param string $attribute
     * @return void
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * @return int
     */
    public function getL10nParent()
    {
        return $this->l10nParent;
    }

    /**
     * @param int $l10nParent
     */
    public function setL10nParent(int $l10nParent)
    {
        $this->l10nParent = $l10nParent;
    }
}
