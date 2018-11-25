<?php

use App\Database\Migration\TableAlter;
use App\Database\Table;

/**
 * Class UsersAddDetails
 */
class UsersAddDetails extends TableAlter
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
        $table->string('firstName');
        $table->string('lastName');
        $table->date('birthday');
        $table->string('gender');
        $table->boolean('active')->default(0);
    }

    /**
     * @param Table $table
     * @return void
     */
    protected function onDown(Table $table)
    {
        $table->dropColumn('firstName');
        $table->dropColumn('lastName');
        $table->dropColumn('birthday');
        $table->dropColumn('gender');
    }
}
