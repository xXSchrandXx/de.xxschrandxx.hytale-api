<?php

namespace wcf\data\hytale;

use wcf\data\DatabaseObjectEditor;

/**
 * Hytale Editor class
 *
 * @author   xXSchrandXx
 * @license  Creative Commons Zero v1.0 Universal (http://creativecommons.org/publicdomain/zero/1.0/)
 * @package  WoltLabSuite\Core\Data\Hytale
 */
class HytaleEditor extends DatabaseObjectEditor
{
    /**
     * @inheritDoc
     */
    protected static $baseClass = Hytale::class;
}
