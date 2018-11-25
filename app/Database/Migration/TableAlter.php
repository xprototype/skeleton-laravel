<?php

namespace App\Database\Migration;

use App\Database\Migration;
use App\Database\Schema;
use App\Database\Table;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class TableAlter
 * @package App\Database\Migration
 */
abstract class TableAlter extends Migration
{
    /**
     * @var string
     */
    protected $table = '';

    /**
     * @var bool
     */
    protected $modifiable = true;

    /**
     * @param Table $table
     * @return void
     */
    protected abstract function onUp(Table $table);

    /**
     * @param Table $table
     * @return void
     */
    protected abstract function onDown(Table $table);

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::alter($this->table, function (Blueprint $blueprint) {
            $this->onUp(Table::make($blueprint));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::alter($this->table, function (Blueprint $blueprint) {
            $this->onDown(Table::make($blueprint));
        });
    }
}
