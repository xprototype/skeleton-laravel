<?php

use App\Database\Migration\TableAlter;
use App\Database\Table;

/**
 * Class PasswordResetsAddFields
 */
class PasswordResetsAddFields extends TableAlter
{
    /**
     * @var string
     */
    protected $table = 'password_resets';

    /**
     * @param Table $table
     * @return void
     */
    protected function onUp(Table $table)
    {
        $table->string('password')->nullable();
    }

    /**
     * @param Table $table
     * @return void
     */
    protected function onDown(Table $table)
    {
        $table->dropColumn('password');
    }
}
