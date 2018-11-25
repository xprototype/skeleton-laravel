<?php

namespace App\Domains\Common;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface RepositoryInterface
 * @package App\Domains
 */
interface RepositoryInterface
{
    /**
     * @param array $data
     * @return string
     */
    public function create(array $data);

    /**
     * @param array $filters
     * @return Collection
     */
    public function read(array $filters);

    /**
     * @param array $data
     * @param array $filters
     * @return int
     */
    public function update(array $data, array $filters);

    /**
     * @param array|string $filters
     * @return int
     */
    public function delete($filters);

    /**
     * @return array
     */
    public function fillable();

    /**
     * @return string
     */
    public function referenceKey();
}
