<?php

namespace App\Domains\Common;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as Auditing;
use Ramsey\Uuid\Uuid;
use Spatie\BinaryUuid\HasBinaryUuid;

/**
 * Class Model
 * @property string id
 * @package App\Domains
 * @method Model create(array $attributes = [])
 * @method Model where(string $column, mixed $operator, mixed $value = null)
 * @method Model first()
 * @method static Collection withUuid(string $id)
 * @method Collection get($columns = ['*'])
 */
abstract class Model extends Eloquent implements ModelInterface, Auditing
{
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * @see SoftDeletes
     */
    use SoftDeletes;

    /**
     * @see HasBinaryUuid
     */
    use HasBinaryUuid;

    /**
     * @see Auditable
     */
    use Auditable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'uuid',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $encoded = [];

    /**
     * Get the primary key for the model.
     *
     * @return string
     */
    public function getKeyName()
    {
        return 'uuid';
    }

    /**
     * Get the exposed primary key for the model.
     *
     * @return string
     */
    public function exposedKey()
    {
        return 'id';
    }

    /**
     * @return array
     */
    public function getEncoded()
    {
        return $this->encoded;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getValue(string $name)
    {
        return $this->getAttributeValue($name);
    }

    /**
     * @return array
     * @throws Exception
     */
    public static function produceUuid(): array
    {
        $uuid = Uuid::uuid1();
        return [
            'id' => $uuid,
            'uuid' => static::encodeUuid($uuid),
        ];
    }

    /**
     * @param array $avoid
     * @return array
     */
    public function except(array $avoid)
    {
        $values = $this->toArray();

        $callback = function ($key) use ($avoid) {
            return !in_array($key, $avoid);
        };

        return array_filter($values, $callback, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        if (!$this->exists) {
            return parent::toArray();
        }

        $data = parent::toArray();

        if (isset($data[$this->getKeyName()])) {
            unset($data[$this->getKeyName()]);
        }

        return $data;
    }

    /**
     *
     */
    protected static function bootHasBinaryUuid()
    {
        static::creating(function (Model $model) {
            if ($model->{$model->getKeyName()}) {
                return;
            }

            $uuid = Uuid::uuid1();
            $model->id = $uuid->toString();
            $model->{$model->getKeyName()} = static::encodeUuid($uuid);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function transformAudit(array $data): array
    {
        if (isset($data['auditable_id'])) {
            $data['auditable_id'] = static::decodeUuid($data['auditable_id']);
        }
        if (isset($data['user_id'])) {
            $data['user_id'] = static::encodeUuid($data['user_id']);
        }
        return $data;
    }
}
