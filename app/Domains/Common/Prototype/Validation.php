<?php

namespace App\Domains\Common\Prototype;

/**
 * Trait Validation
 * @package App\Domains\Common\Prototype
 */
trait Validation
{
    /**
     * @param string $scope
     * @return array
     */
    public function getValidationRules(string $scope): array
    {
        return [
            'age' => 'required|numeric',
            'email' => 'required|email',
            'description' => 'required|string',
            'address' => 'required|string',
            'type' => 'required|numeric',
        ];
    }
}
