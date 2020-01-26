<?php
namespace Media711\KastoProducts\ViewHelpers;

use Media711\KastoProducts\Domain\Model\Product;
use Media711\KastoProducts\Domain\Model\Table;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class class TablesParserViewHelper
 *
 * ViewHelper that build technical data tables by table objects related to product via exploding by '|'
 *
 * @author Dmytro Doronenko
 */
class TablesParserViewHelper extends AbstractViewHelper
{
    /**
     * initialize arguments
     */
    public function initializeArguments()
    {
        $this->registerArgument('tables', 'TYPO3\CMS\Extbase\Persistence\ObjectStorage', 'Technical data objects', true);
        $this->registerArgument('product', 'Media711\KastoProducts\Domain\Model\Product', 'Product data', true);
    }

    /**
     *
     * @return string
     */
    public function render()
    {
        $html       = '';
        $identifier = 'pTable';
        $materialShapingValues = '';

        /** @var Product $product */
        $product = $this->arguments['product'];
        if ($product->getMaterialShaping()) {
            foreach (explode(',', $product->getMaterialShaping()) as $materShaping) {
                $materialShapingValues .= "<span class='" . $materShaping . "'></span>";
            }
        }

        $iterator = 0;

        /** @var Table $tableData */
        foreach ($this->arguments['tables'] as $tableData) {
            $activeClass = ($iterator == 0) ? ' show' : '';
            $expanded    = ($iterator == 0) ? ' aria-expanded="true" '  : '';
            $html .= '<div class="table-responsive"><table class="card technical-data-table">';
            $html .= '<thead data-toggle="collapse" data-target="#' . $identifier . $tableData->getUid().'" aria-controls="';
            $html .= $identifier . $tableData->getUid() .'"' . $expanded .'><tr><th>' . $tableData->getHeader();
            $html .= '<span class="round-shape"><span class="circle"><span class="horizontal"></span>';
            $html .= '<span class="vertical"></span></span></span>';
            $html .= '</th></tr></thead>';
            $trs   = explode(PHP_EOL, $tableData->getStructure());

            $html .= '<tbody id="' . $identifier . $tableData->getUid() .'" class="collapse' . $activeClass . '">';
            if (is_array($trs)) {
                foreach ($trs as $tds) {
                    $values = explode('|', $tds);
                    $html  .= '<tr><td><div>' . $values[0] . '</div></td><td><div>' .
                        str_replace('{{Materialform}}', $materialShapingValues, $values[1]) . '</div></td></tr>';
                }
            }
            $html .= '</tbody></table></div>';
            $iterator++;
        }


        return $html;
    }
}
