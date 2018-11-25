<?php

use App\Database\Migration\TableAlter;
use App\Database\Table;

/**
 * Class UsersAddPersonal
 */
class UsersAddPersonal extends TableAlter
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @param Table $table
     * @return void
     */
    protected function onUp(Table $table)
    {
        $table->string('photo')->default('');
    }

    /**
     * @param Table $table
     * @return void
     */
    protected function onDown(Table $table)
    {
        $table->dropColumn('photo');
    }
}
