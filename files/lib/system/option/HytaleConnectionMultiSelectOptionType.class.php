<?php

namespace wcf\system\option;

use wcf\data\option\Option;
use wcf\data\hytale\HytaleList;
use wcf\system\exception\UserInputException;
use wcf\system\WCF;
use wcf\util\ArrayUtil;

/**
 * HytaleConnectionMultiSelect OptionType class
 * Custom option type for multiple hytale connections
 * Name of option type: HytaleConnectionMultiSelect
 *
 * @author   xXSchrandXx
 * @license  Creative Commons Zero v1.0 Universal (http://creativecommons.org/publicdomain/zero/1.0/)
 * @package  WoltLabSuite\Core\System\Option
 */
class HytaleConnectionMultiSelectOptionType extends AbstractOptionType
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
            'value' => !is_array($value) ? explode("\n", $value) : $value
        ]);
        return WCF::getTPL()->fetch('hytaleConnectionMultiSelectOptionType');
    }

    /**
     * @inheritDoc
     */
    public function validate(Option $option, $newValue)
    {
        if (!\is_array($newValue)) {
            $newValue = [];
        }
        $newValue = ArrayUtil::toIntegerArray($newValue);

        $hytaleList = new HytaleList();
        $hytaleList->setObjectIDs($newValue);
        $hytaleList->readObjectIDs();

        foreach ($newValue as $value) {
            if (!\in_array($value, $hytaleList->getObjectIDs())) {
                throw new UserInputException($option->optionName);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function getData(Option $option, $newValue)
    {
        if (!\is_array($newValue)) {
            $newValue = [];
        }
        return \implode("\n", ArrayUtil::toIntegerArray($newValue));
    }
}
