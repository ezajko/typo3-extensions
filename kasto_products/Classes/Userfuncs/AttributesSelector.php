<?php
namespace Media711\KastoProducts\Userfuncs;

use Media711\KastoProducts\ProductAttributesTrait;

/**
 * Class AttributesSelector
 */
class AttributesSelector
{
    use ProductAttributesTrait;

    /**
     * gets value depends on selected type
     *
     * @param array $params
     */
    public function getItems(array &$params)
    {
        $conditionField = 'type';

        if ((int)reset($params['row'][$conditionField]) == 1) {
            $attributes = ProductAttributesTrait::getProductAttributes()['saw_attributes'] ?? [];
        } elseif ((int)reset($params['row'][$conditionField]) == 2) {
            $attributes = ProductAttributesTrait::getProductAttributes()['storage_attributes'] ?? [];
        } elseif ((int)reset($params['row'][$conditionField]) == 6) {
            $attributes = ProductAttributesTrait::getProductAttributes()['system_attributes'] ?? [];
        }

        if (isset($attributes)) {
            foreach ($attributes as $value) {
                $params['items'][] = [
                    'LLL:EXT:kasto_products/Resources/Private/Language/locallang_db.xlf:' .
                    'tx_kastoproducts_domain_model_product.' . $value,
                    $value
                ];
            }
        }
    }
}
