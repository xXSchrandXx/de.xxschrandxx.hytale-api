<?php

namespace wcf\system\option;

use wcf\data\option\Option;
use wcf\data\hytale\Hytale;
use wcf\data\hytale\HytaleList;
use wcf\system\exception\UserInputException;
use wcf\system\WCF;

/**
 * HytaleConnectionSelect OptionType class
 * Custom option type for hytale connections
 * Name of option type: HytaleConnectionSelect
 *
 * @author   xXSchrandXx
 * @license  Creative Commons Zero v1.0 Universal (http://creativecommons.org/publicdomain/zero/1.0/)
 * @package  WoltLabSuite\Core\System\Option
 */
class HytaleConnectionSelectOptionType extends AbstractOptionType
{
    /**
     * @inheritDoc
     */
    public function getFormElement(Option $option, $value)
    {
        $hytaleList = new HytaleList();
        $hytaleList->sqlOrderBy = 'title ASC';
        $hytaleList->readObjects();

        WCF::getTPL()->assign([
            'hytaleList' => $hytaleList,
            'option' => $option,
            'value' => $value
        ]);
        return WCF::getTPL()->fetch('hytaleConnectionSelectOptionType');
    }

    /**
     * @inheritDoc
     */
    public function validate(Option $option, $newValue)
    {
        if (!empty($newValue)) {
            $hytale = new Hytale($newValue);
            if (!$hytale->getObjectID()) {
                throw new UserInputException($option->optionName);
            }
        }
    }
}
