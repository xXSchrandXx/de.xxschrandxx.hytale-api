<?php

namespace wcf\acp\form;

use wcf\data\hytale\Hytale;
use wcf\system\exception\IllegalLinkException;

/**
 * HytaleEdit Form class
 *
 * @author   xXSchrandXx
 * @license  Creative Commons Zero v1.0 Universal (http://creativecommons.org/publicdomain/zero/1.0/)
 * @package  WoltLabSuite\Core\Acp\Form
 */
class HytaleEditForm extends HytaleAddForm
{
    /**
     * @inheritDoc
     */
    public $formAction = 'edit';

    /**
     * @inheritDoc
     */
    public function readParameters()
    {
        parent::readParameters();

        $hytaleID = 0;
        if (isset($_REQUEST['id'])) {
            $hytaleID = (int)$_REQUEST['id'];
        }
        $this->formObject = new Hytale($hytaleID);
        if (!$this->formObject->hytaleID) {
            throw new IllegalLinkException();
        }
    }

    /**
     * @inheritDoc
     */
    public function setFormObjectData()
    {
        parent::setFormObjectData();

        /** @var PasswordFormField $passwordField */
        $passwordField = $this->form->getNodeById('password');
        $passwordField->value('');
    }
}
