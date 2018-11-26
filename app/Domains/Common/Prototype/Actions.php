<?php

namespace App\Domains\Common\Prototype;

/**
 * Trait Actions
 * @package App\Domains\Common\Prototype
 */
trait Actions
{
    /**
     * @param string $scope
     * @return array
     */
    public function getActions(string $scope): array
    {
        return [];
    }
}
