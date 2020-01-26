<?php
namespace Media711\KastoProducts\ViewHelpers\Format;

use Media711\KastoProducts\ViewHelpers\ViewHelperTrait;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class TabsTitleViewHelper
 *
 * ViewHelper has the same function like ItalicTextViewHelper but extended with getting of number for tabs titles view
 */
class TabsTitleViewHelper extends AbstractViewHelper
{
    use ViewHelperTrait;

    /**
     * initialize arguments
     */
    public function initializeArguments()
    {
        $this->registerArgument('text', 'string', 'Text');
        $this->registerArgument('isCursive', 'bool', 'Skip cursive');
    }

    /**
     * method has the same function like italicText viewHelper but extended with getting of number for tabs titles view
     *
     * @return mixed|string
     */
    public function render()
    {
        $text = $this->italicText($this->arguments['text'], $this->arguments['isCursive']);

        return '<span class="h3 title">' . preg_replace('/[^0-9.]/', '', $text) . '</span>' .
            '<span class="product-title">' . $text  . '</span>';
    }
}
