<?php

namespace App\Domains\Common\Prototype;

use App\Domains\Common\Prototype;

/**
 * Trait Properties
 * @package App\Domains\Common\Prototype
 */
trait Properties
{
    /**
     * @var array
     */
    protected $scopes = ['index' => 'All', 'add' => 'Create', 'view' => 'View', 'edit' => 'Edit'];

    /**
     * @var string
     */
    protected $icon = 'tint';

    /**
     * @return array
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * @param string $scope
     * @param mixed $default
     * @return mixed|null
     */
    public function getScope(string $scope, $default = null)
    {
        return $this->scopes[$scope] ?? $default;
    }

    /**
     * @param array $scopes
     * @return Prototype
     */
    protected function scopes(array $scopes): Prototype
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }
}
