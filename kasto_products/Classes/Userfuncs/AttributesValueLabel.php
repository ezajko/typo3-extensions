<?php
namespace Media711\KastoProducts\Userfuncs;

use Media711\KastoProducts\ProductAttributesTrait;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class AttributesSelector
 */
class AttributesValueLabel
{
    use ProductAttributesTrait;

    /**
     * gets value depends on selected type
     *
     * @param array $parameters
     * @param object $parentObject
     */
    public function getLabel(array &$parameters, $parentObject)
    {
        $conditionField = 'type';

        $record = BackendUtility::getRecord($parameters['table'], $parameters['row']['uid']);
        // attribute value
        $value = $record['value'];

        // type
        $typeRecord = BackendUtility::getRecord('tx_kastoproducts_domain_model_type', $record['type']);
        $typeLabel = $typeRecord['title'];

        // attribute name
        if ($attributeLLL = BackendUtility::getItemLabel('tx_kastoproducts_domain_model_product', $record['attribute'])) {
            $attributeLabel = $this->getLanguageService()->sL($attributeLLL);
        } else {
            $attributeLabel = '---';
        }

        $newTitle =  $value . ' (' . $typeLabel . ', ' . $attributeLabel . ')';
        $parameters['title'] = $newTitle;
    }

    /**
     * @return \TYPO3\CMS\Lang\LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}
