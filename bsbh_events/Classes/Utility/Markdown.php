<?php

namespace Dkd\BsbhEvents\Utility;

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
 *
 * (c) 2019 Tarang Patel <tarang.patel@dkd.de>, dkd Internet Service GmbH
 */
use HTMLPurifier;
use Parsedown;

/**
 * Markdown related utilities
 *
 * @package Dkd\BsbhEvents\Utility
 */
class Markdown
{
    /**
     * Parsedown instance
     *
     * @var null|\Parsedown
     */
    protected $Parsedown = null;
    /**
     * HTML Purifier instance
     *
     * @var \HTMLPurifier|null
     */
    protected $Purifier = null;

    /**
     * Markdown constructor.
     */
    public function __construct()
    {
        $this->Parsedown = new Parsedown();
        $this->Purifier = new HTMLPurifier();
    }

    /**
     * Set additional HTML Purifier configuration
     *
     * @see http://htmlpurifier.org/live/configdoc/plain.html
     * @param $key
     * @param $value
     */
    public function setPurifierConfigurationParameter($key, $value)
    {
        $this->Purifier->config->set($key, $value);
    }

    /**
     * Parses a given markdown input string and outputs corresponding html.
     * Markdown is generated via
     * The output is sanitized using htmlpurifier.
     *
     * @see http://parsedown.org/
     * @see https://github.com/erusev/parsedown
     * @see http://htmlpurifier.org/
     * @see https://github.com/ezyang/htmlpurifier
     *
     * @param string $markdown to parse
     * @return string html output
     */
    public function parse($markdown)
    {
        $this->Purifier->config->set('Cache.SerializerPath', $GLOBALS['_SERVER']['DOCUMENT_ROOT'] . '/typo3temp');
        if (!is_string($markdown)) {
            return $markdown;
        }

        return $this->Purifier->purify($this->Parsedown->text($markdown));
    }
}
