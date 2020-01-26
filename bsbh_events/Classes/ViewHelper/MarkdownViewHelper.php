<?php
namespace Dkd\BsbhEvents\ViewHelpers;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * Outputs the given markdown input as HTML
 */
class MarkdownViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * Converts given markdown input to HTML
     *
     * @see https://github.com/erusev/parsedown
     * @see http://htmlpurifier.org/
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     *
     * @return string
     */

    /**
     * Arguments Initialization
     */
    public function initializeArguments()
    {
        $this->registerArgument(
            'forbiddenTags',
            'string',
            'HTML tags to filter. Commaseparated list',
            false
        );
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $markdownConverter = GeneralUtility::makeInstance(\Dkd\BsbhEvents\Utility\Markdown::class);
        $forbiddenTags = GeneralUtility::trimExplode(',', $arguments['forbiddenTags']);
        if ($forbiddenTags) {
            $markdownConverter->setPurifierConfigurationParameter('HTML.ForbiddenElements', $forbiddenTags);
        }
        return $markdownConverter->parse($renderChildrenClosure());
    }
}
