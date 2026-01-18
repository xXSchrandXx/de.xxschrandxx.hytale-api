<?php

namespace wcf\data\hytale;

use wcf\data\AbstractDatabaseObjectAction;

/**
 * Hytale Action class
 *
 * @author   xXSchrandXx
 * @license  Creative Commons Zero v1.0 Universal (http://creativecommons.org/publicdomain/zero/1.0/)
 * @package  WoltLabSuite\Core\Data\Hytale
 */
class HytaleAction extends AbstractDatabaseObjectAction
{
    /**
     * @inheritDoc
     */
    protected $className = HytaleEditor::class;

    /**
     * @inheritDoc
     */
    protected $permissionsCreate = ['admin.hytale.canManageConnection'];

    /**
     * @inheritDoc
     */
    protected $permissionsDelete = ['admin.hytale.canManageConnection'];

    /**
     * @inheritDoc
     */
    protected $permissionsUpdate = ['admin.hytale.canManageConnection'];

    /**
     * @inheritDoc
     */
    protected $requireACP = ['create', 'delete', 'update'];

    /**
     * @inheritDoc
     */
    public function update()
    {
        if (isset($this->parameters['data']['password']) && empty($this->parameters['data']['password'])) {
            unset($this->parameters['data']['password']);
        }

        parent::update();
    }
}
