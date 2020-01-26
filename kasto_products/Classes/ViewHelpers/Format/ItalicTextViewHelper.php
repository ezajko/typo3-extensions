<?php
namespace Media711\KastoProducts\ViewHelpers\Format;

use Media711\KastoProducts\ViewHelpers\ViewHelperTrait;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class ItalicTextViewHelper
 *
 * @author Dmytro Doronenko
 */
class ItalicTextViewHelper extends AbstractViewHelper
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
     * @return mixed|string
     */
    public function render()
    {
        return $this->italicText($this->arguments['text'], $this->arguments['isCursive']);
    }
}
