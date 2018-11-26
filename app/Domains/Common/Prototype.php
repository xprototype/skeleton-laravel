<?php

namespace App\Domains\Common;

use App\Domains\Common\Prototype\Actions;
use App\Domains\Common\Prototype\Binary;
use App\Domains\Common\Prototype\Events;
use App\Domains\Common\Prototype\Fields;
use App\Domains\Common\Prototype\Keys;
use App\Domains\Common\Prototype\Properties;
use App\Domains\Common\Prototype\Validation;
use App\Domains\Common\Prototype\Values;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as Auditing;
use Spatie\BinaryUuid\HasBinaryUuid;
use Throwable;

/**
 * Class Prototype
 * @property string id
 * @package App\Domains
 * @method Prototype create(array $attributes = [])
 * @method Prototype where(string $column, mixed $operator, mixed $value = null)
 * @method Prototype first()
 * @method static Collection withUuid(string $id)
 * @method Collection get($columns = ['*'])
 */
abstract class Prototype extends Eloquent implements PrototypeInterface, Auditing
{
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * @trait external
     */
    use HasBinaryUuid, Auditable, SoftDeletes;

    /**
     * @trait internal
     */
    use Keys, Events, Values, Binary, Properties, Fields, Actions, Validation;

    /** @noinspection PhpMissingParentConstructorInspection */
    /**
     * Prototype constructor.
     */
    public function __construct()
    {
        try {
            /** @noinspection PhpUndefinedMethodInspection */
            parent::construct();
        } catch (Throwable $exception) {
            // silent
        }
        $this->construct();
    }

    /**
     * @return string
     */
    abstract public function domain(): string;

    /**
     * @return void
     */
    abstract public function construct();
}
