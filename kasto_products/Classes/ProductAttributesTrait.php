<?php
declare(strict_types=1);
namespace Media711\KastoProducts;

/**
 * Class ProductAttributesTrait
 *
 * @package kasto_products
 */
trait ProductAttributesTrait
{
    /**
     * return array of all possible static product attributes
     *
     * @return array
     */
    public static function getProductAttributes(): array
    {
        return [
            'saw_attributes' => [
                'cutting_option',
                'model_series',
                'application_area',
                'material',
                'cut_count',
                'saw_type',
                'saw_automation',
                'material_shaping',
                'material_width',
                'material_height',
                'material_diameter',
                'material_square',
                'cut_width',
                'cut_length',
            ],
            'storage_attributes' => [
                'storage_style',
                'storage_type'
            ],
            'system_attributes' => [
                'system_name'
            ]
        ];
    }
}
