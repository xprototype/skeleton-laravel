<?php

use App\Database\Migration\TableCreate;
use App\Database\Table;

/**
 * Class PasswordResetsCreateTable
 */
class PasswordResetsCreateTable extends TableCreate
{
    /**
     * @var string
     */
    protected $table = 'password_resets';

    /**
     * @var bool
     */
    protected $modifiable = false;

    /**
     * @param Table $table
     * @return void
     */
    protected function withStatements(Table $table)
    {
        $table->string('email')->index();
        $table->string('token');
    }
}
