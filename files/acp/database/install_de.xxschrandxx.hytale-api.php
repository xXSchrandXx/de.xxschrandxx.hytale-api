<?php

use wcf\system\database\table\column\NotNullInt10DatabaseTableColumn;
use wcf\system\database\table\column\NotNullVarchar191DatabaseTableColumn;
use wcf\system\database\table\column\ObjectIdDatabaseTableColumn;
use wcf\system\database\table\column\NotNullVarchar255DatabaseTableColumn;
use wcf\system\database\table\column\VarcharDatabaseTableColumn;
use wcf\system\database\table\index\DatabaseTablePrimaryIndex;
use wcf\system\database\table\DatabaseTable;
use wcf\system\database\table\index\DatabaseTableIndex;

return [
    DatabaseTable::create('wcf1_hytale')
        ->columns([
            ObjectIdDatabaseTableColumn::create('hytaleID'),
            VarcharDatabaseTableColumn::create('title')
                ->length(20),
            NotNullVarchar191DatabaseTableColumn::create('user'),
            NotNullVarchar255DatabaseTableColumn::create('password'),
            NotNullInt10DatabaseTableColumn::create('creationDate')
        ])
        ->indices([
            DatabaseTablePrimaryIndex::create()
                ->columns(['hytaleID']),
            DatabaseTableIndex::create('user')
                ->type(DatabaseTableIndex::UNIQUE_TYPE)
                ->columns(['user'])
        ])
];
