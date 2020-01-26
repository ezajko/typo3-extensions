<?php
namespace Media711\KastoProducts\ViewHelpers;

/**
 * Trait ViewHelperTrait
 *
 * be used for custom viewHelpers
 */
trait ViewHelperTrait
{
    /**
     * @param $text
     * @param $isCursive
     * @return string
     */
    public function italicText($text, $isCursive) : string
    {
        # Automatic italicization
        if ($isCursive == false) {
            if ((stripos($text, '<') === false) && (stripos($text, '>') === false)) {
                if ((stripos($text, 'KASTO') === 0) && ($text[5] != ' ')) {
                    $text = str_ireplace('KASTO', 'KASTO<em class="sufix">', $text) . '</em>';
                }
            }
        }

        # Manual italics
        if ((stripos($text, '[') !== false) && (stripos($text, ']') !== false)) {
            $text = str_replace('[', '<em class="sufix">', $text);
            $text = str_replace(']', '</em>', $text);
        }

        return $text;
    }
}
