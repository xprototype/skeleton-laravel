<?php

namespace App\Domains\Common;

/**
 * Trait RepositoryHelper
 * @package App\Domains
 */
trait RepositoryHelper
{
    /**
     * @return array
     */
    public function fillable()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->model->getFillable();
    }

    /**
     * @return string
     */
    public function referenceKey()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->model->getKeyName();
    }

    /**
     * @return string
     */
    public function exposedKey()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->model->exposedKey();
    }

    /**
     * @param array $filters
     * @return Model
     */
    private function where(array $filters)
    {
        $model = clone $this->model;

        /** @noinspection PhpUndefinedMethodInspection */
        $encoded = $model->getEncoded();

        foreach ($filters as $column => $value) {
            if (in_array($column, $encoded)) {
                /** @noinspection PhpUndefinedMethodInspection */
                $value = $model::encodeUuid($value);
            }
            /** @noinspection PhpUndefinedMethodInspection */
            $model = $model->where($column, $value);
        }
        return $model;
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function findById(string $id)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->model::withUuid($id)->first();
    }
}
