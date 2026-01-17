<?php

namespace wcf\acp\page;

use wcf\data\hytale\Hytale;
use wcf\data\hytale\HytaleList;
use wcf\page\MultipleLinkPage;

/**
 * HytaleList Page class
 *
 * @author   xXSchrandXx
 * @license  Creative Commons Zero v1.0 Universal (http://creativecommons.org/publicdomain/zero/1.0/)
 * @package  WoltLabSuite\Core\Acp\Page
 */
class HytaleListPage extends MultipleLinkPage
{
    /**
     * @inheritDoc
     */
    public $objectListClassName = HytaleList::class;

    /**
     * @inheritDoc
     */
    public $sortOrder = 'ASC';

    /**
     * @inheritDoc
     */
    public $activeMenuItem = 'wcf.acp.menu.link.configuration.hytale.hytaleList';

    /**
     * @inheritDoc
     */
    public function __run()
    {
        $this->sortField = Hytale::getDatabaseTableIndexName();
        parent::__run();
    }
}
