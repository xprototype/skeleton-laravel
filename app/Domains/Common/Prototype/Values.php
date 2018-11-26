<?php

namespace App\Domains\Common\Prototype;

/**
 * Trait Values
 * @package App\Domains\Common\Prototype
 */
trait Values
{
    /**
     * @param string $name
     * @return mixed
     */
    public function getValue(string $name)
    {
        return $this->getAttributeValue($name);
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
            /** @noinspection PhpUndefinedClassInspection */
            return parent::toArray();
        }

        /** @noinspection PhpUndefinedClassInspection */
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
        static::creating(function (Prototype $model) {
            if ($model->{$model->getKeyName()}) {
                return;
            }

            $uuid = Uuid::uuid1();
            $model->id = $uuid->toString();
            $model->{$model->getKeyName()} = static::encodeUuid($uuid);
        });
    }
}
