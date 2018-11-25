<?php

namespace App\Domains\Common;

use App\Domains\Util\Instance;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Repository
 * @package App\Domains
 */
abstract class Repository implements RepositoryInterface
{
    /**
     * @trait
     */
    use RepositoryHelper, Instance;

    /**
     * @var Model
     */
    protected $model;

    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @link http://php.net/manual/en/language.oop5.decon.php
     * @param ModelInterface $model
     */
    public function __construct(ModelInterface $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return string
     */
    public function create(array $data)
    {
        $encoded = $this->model->getEncoded();

        foreach ($data as $column => $value) {
            if (!in_array($column, $encoded)) {
                continue;
            }
            $data[$column] = $this->model::encodeUuid($value);
        }

        $newest = $this->model->create($data);
        return $newest->id;
    }

    /**
     * @param array $filters
     * @return Collection
     */
    public function read(array $filters)
    {
        $keys = [$this->exposedKey(), $this->referenceKey()];
        $columns = array_merge($keys, $this->model->getFillable());

        return $this->where($filters)->get($columns);
    }

    /**
     * @param array $data
     * @param array $filters
     * @return int
     */
    public function update(array $data, array $filters)
    {
        return $this->where($filters)->update($data);
    }

    /**
     * @param array|string $filters
     * @return int
     */
    public function delete($filters)
    {
        return $this->model->destroy($filters);
    }
}
