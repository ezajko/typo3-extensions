<?php
namespace Media711\KastoProducts\Hook;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * Class AddTableWizardJsHook
 */
class AddTableWizardJsHook
{
    /**
     * include custom js file to PageRender hook for BE
     *
     * @param $params
     * @param PageRenderer $parentObject
     */
    public function postRender(&$params, &$parentObject)
    {
        if (TYPO3_MODE === 'BE') {
            $params['jsFooterFiles'] .= '<script src="../' . ExtensionManagementUtility::siteRelPath('kasto_products') .
                                'Resources/Public/JavaScript/Wizard/jquery.tablednd.min.js"></script>';

            $params['jsFooterFiles'] .= '<script src="../' . ExtensionManagementUtility::siteRelPath('kasto_products') .
                'Resources/Public/JavaScript/Wizard/tableWizard.js"></script>';

            // css
            $params['cssFiles'] .= '<link rel="stylesheet" type="text/css" href="/' .
                ExtensionManagementUtility::siteRelPath('kasto_products') . 'Resources/Public/Styles/tableWizard.css">';
        }
    }
}
