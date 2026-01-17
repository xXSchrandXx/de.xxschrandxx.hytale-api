<?php

namespace wcf\acp\form;

use wcf\data\IStorableObject;
use wcf\data\hytale\HytaleAction;
use wcf\data\hytale\HytaleList;
use wcf\form\AbstractFormBuilderForm;
use wcf\system\form\builder\container\FormContainer;
use wcf\system\form\builder\data\processor\CustomFormDataProcessor;
use wcf\system\form\builder\field\PasswordFormField;
use wcf\system\form\builder\field\TextFormField;
use wcf\system\form\builder\field\TitleFormField;
use wcf\system\form\builder\field\validation\FormFieldValidationError;
use wcf\system\form\builder\field\validation\FormFieldValidator;
use wcf\system\form\builder\IFormDocument;
use wcf\system\user\authentication\password\PasswordAlgorithmManager;

/**
 * HytaleAdd Form class
 *
 * @author   xXSchrandXx
 * @license  Creative Commons Zero v1.0 Universal (http://creativecommons.org/publicdomain/zero/1.0/)
 * @package  WoltLabSuite\Core\Acp\Form
 */
class HytaleAddForm extends AbstractFormBuilderForm
{
    /**
     * @inheritDoc
     */
    public $neededPermissions = ['admin.hytale.canManageConnection'];

    /**
     * @inheritDoc
     */
    public $activeMenuItem = 'wcf.acp.menu.link.configuration.hytale.hytaleList.add';

    /**
     * @inheritDoc
     */
    public $objectActionClass = HytaleAction::class;

    /**
     * @inheritDoc
     * @var \wcf\data\hytale\Hytale
     */
    public $formObject;

    /**
     * @inheritDoc
     */
    protected function createForm()
    {
        parent::createForm();

        $this->form->appendChild(
            FormContainer::create('data')
                ->appendChildren([
                    TitleFormField::create()
                        ->value('Default')
                        ->maximumLength(20)
                        ->required(),
                    TextFormField::create('user')
                        ->label('wcf.acp.form.hytaleAdd.user')
                        ->required()
                        ->addValidator(new FormFieldValidator('duplicate', function (TextFormField $field) {
                            if ($this->formAction === 'edit' && $this->formObject->getUser() === $field->getValue()) {
                                return;
                            }
                            $hytaleList = new HytaleList();
                            $hytaleList->getConditionBuilder()->add('user = ?', [$field->getValue()]);
                            if ($hytaleList->countObjects() !== 0) {
                                $field->addValidationError(
                                    new FormFieldValidationError(
                                        'duplicate',
                                        'wcf.acp.form.hytaleAdd.user.error.duplicate'
                                    )
                                );
                            }
                        })),
                    PasswordFormField::create('password')
                        ->label('wcf.acp.form.hytaleAdd.password')
                        ->placeholder(($this->formAction == 'edit') ? 'wcf.acp.updateServer.loginPassword.noChange' : '')
                        ->required($this->formAction !== 'edit')
                ])
        );

        $this->form->getDataHandler()->addProcessor(new CustomFormDataProcessor(
            'password',
            static function (IFormDocument $document, array $parameters) {
                /** @var PasswordFormField $passwordField */
                $passwordField = $document->getNodeById('password');
                if (!empty($passwordField->getSaveValue())) {
                    $manager = PasswordAlgorithmManager::getInstance();
                    $algorithm = $manager->getDefaultAlgorithm();
                    $algorithmName = PasswordAlgorithmManager::getInstance()->getNameFromAlgorithm($algorithm);
                    $parameters['data']['password'] = $algorithmName . ':' . $algorithm->hash($passwordField->getSaveValue());
                }
                return $parameters;
            },
            static function (IFormDocument $document, array $parameters, IStorableObject $object) {
                unset($parameters['data']['password']);
                return $parameters;
            }
        ));
    }

    /**
     * @inheritDoc
     */
    public function save()
    {
        if ($this->formAction == 'create') {
            $this->additionalFields['creationDate'] = TIME_NOW;
        }

        parent::save();
    }
}
