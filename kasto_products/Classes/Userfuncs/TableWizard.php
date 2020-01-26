<?php
namespace Media711\KastoProducts\Userfuncs;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class TableWizard
 *
 * @author Dmytro Doronenko
 */
class TableWizard
{
    /**
     * method for custom table wizard generation
     *
     * @param $params
     * @param $fObj
     * @return string
     */
    public function customTableManager($params, $fObj)
    {
        if (isset($params['itemFormElValue'])) {
            $uniqueIdentifier = uniqid();
            $formField =
                '<div class="form-control-wrap product-technical-data-table-wrapper" style="max-width: 480px">
                    <div class="form-wizards-wrap">
                        <div class="form-wizards-element">
                            <textarea id="formengine-textarea-'. $uniqueIdentifier .'"
                                       name="' . $params['itemFormElName'] . '" 
                                       data-formengine-validation-rules="[]" 
                                       data-formengine-input-name="' . $params['itemFormElName'] . '" 
                                       onchange="'. $params['fieldChangeFunc']['TBE_EDITOR_fieldChanged'] . '" 
                                       class="table-wizard-textarea form-control t3js-formengine-textarea formengine-textarea"
                                       rows="5"
                                       wrap="virtual" 
                                       style="max-height: 500px">' .$params['itemFormElValue'] .'</textarea>
                        </div>
                        <div class="form-wizards-items-aside">
                            <div class="btn-group product-table-wizard">
                                <a id="toggleModal'. $uniqueIdentifier .'" onclick="return false;" href="" class="btn btn-default modal-trigger"
                                data-toggle="modal" data-target="#myModal' . $uniqueIdentifier . '" data-backdrop="true" >
                                    <span alt="Table Wizard" title="Table Wizard">
                                        <span class="t3js-icon icon icon-size-small icon-state-default icon-content-table" data-identifier="content-table">
                                            <span class="icon-markup">
                                                <img src="/typo3/sysext/core/Resources/Public/Icons/T3Icons/content/content-table.svg" width="16" height="16"
                                                 class="modalDialog">
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div class="btn-group"></div>
                            <div class="form-wizards-items-bottom"> </div>
                        </div>

                        <div class="modal fade" id="myModal'. $uniqueIdentifier .'" tabindex="-1" role="dialog"  aria-hidden="true"' .
                         ' aria-labelledby="toggleModal'. $uniqueIdentifier .'"  data-backdrop="true" >
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close discard-changes" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Edit technical data</h4>
                                    </div>
                                    <div class="modal-body">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default discard-changes" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary save-table" data-dismiss="modal">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>';
        }

        return $formField ?? '';
    }
}
