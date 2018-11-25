<?php

namespace App\Database\Migration;

use App\Database\Migration;
use App\Database\Schema;
use App\Database\Table;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class TableCreate
 * @package App\Database\Migration
 */
abstract class TableCreate extends Migration
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
    protected abstract function withStatements(Table $table);

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->table)) {
            return;
        }
        Schema::create($this->table, function (Blueprint $blueprint) {
            $table = Table::make($blueprint);

            $table->uuid('uuid')->primary();
            $table->string('id')->unique();

            $this->withStatements($table);

            $this->timestamps($table);

            $table->softDeletes();
        });
    }

    /**
     * @param Table $table
     */
    private function timestamps(Table $table)
    {
        if ($this->modifiable) {
            $table->timestamps();
            return;
        }
        $table->timestamp('created_at')->nullable();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
