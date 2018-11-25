<?php

use App\Database\Migration\TableCreate;
use App\Database\Table;

/**
 * Class UsersCreateTable
 */
class UsersCreateTable extends TableCreate
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @param Table $table
     * @return void
     */
    protected function withStatements(Table $table)
    {
        $password = md5('###' . rand(1000, 2000) . '###');
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password')->default($password);
        $table->rememberToken();
    }
}
