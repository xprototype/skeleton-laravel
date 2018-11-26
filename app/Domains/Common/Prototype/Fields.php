<?php

namespace App\Domains\Common\Prototype;

use App\Domains\Common\Prototype;

/**
 * Trait Fields
 * @package App\Domains\Common\Prototype
 */
trait Fields
{
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
     * @param string $name
     * @param string $label
     * @return Prototype
     */
    protected function field(string $name, string $label = ''): Prototype
    {
        /** @var Prototype $this */
        return $this;
    }

    /**
     * @return Prototype
     */
    public function firstName(): Prototype
    {
        /** @var Prototype $this */
        return $this;
    }

    /**
     * @return Prototype
     */
    public function lastName(): Prototype
    {
        /** @var Prototype $this */
        return $this;
    }

    /**
     * @return Prototype
     */
    public function date(): Prototype
    {
        /** @var Prototype $this */
        return $this;
    }

    /**
     * @return Prototype
     */
    public function password(): Prototype
    {
        /** @var Prototype $this */
        return $this;
    }

    /**
     * @param array $options
     * @return Prototype
     */
    public function option(array $options = []): Prototype
    {
        /** @var Prototype $this */
        return $this;
    }

    /**
     * @param callable $callback
     * @return Prototype
     */
    public function calculated(callable $callback): Prototype
    {
        /** @var Prototype $this */
        return $this;
    }

    /**
     * @param bool $hidden
     * @return Prototype
     */
    public function hidden(bool $hidden): Prototype
    {
        /** @var Prototype $this */
        return $this;
    }

    /**
     * @param string $tag
     * @param array $props
     * @return Prototype
     */
    protected function html(string $tag, $props = []): Prototype
    {
        return $this;
    }

    /**
     * @return Prototype
     */
    protected function string(): Prototype
    {
        return $this;
    }

    /**
     * @return Prototype
     */
    protected function email(): Prototype
    {
        return $this;
    }

    /**
     * @return Prototype
     */
    protected function numeric(): Prototype
    {
        return $this;
    }

    /**
     * @return Prototype
     */
    protected function image(): Prototype
    {
        return $this;
    }

    /**
     * @param string $label
     * @return Prototype
     */
    protected function label(string $label): Prototype
    {
        return $this;
    }

    /**
     * @param int $width
     * @param int $span
     * @return Prototype
     */
    protected function form($width = 100, $span = 1): Prototype
    {
        return $this;
    }

    /**
     * @param string $width
     * @return Prototype
     */
    protected function grid($width = 'auto'): Prototype
    {
        return $this;
    }

    /**
     * @param int $height
     * @return Prototype
     */
    protected function height($height = 1): Prototype
    {
        return $this;
    }

    /**
     * @return Prototype
     */
    protected function required(): Prototype
    {
        return $this;
    }

    /**
     * @return Prototype
     */
    protected function primaryKey(): Prototype
    {
        return $this;
    }

    /**
     * @param string $class
     * @return Prototype
     */
    protected function foreign(string $class): Prototype
    {
        return $this;
    }

    /**
     * @param string $scope
     * @return array
     */
    public function getFields(string $scope): array
    {
        return [
            [
                'id' => 'age',
                'label' => 'Age',
                'width' => 50,
                'height' => 1,
                'tag' => 'input',
                'props' => ['type' => 'number', 'name' => 'age', 'placeholder' => 'Age'],
            ],
            [
                'id' => 'age',
                'label' => 'Age',
                'width' => 50,
                'height' => 2,
                'tag' => 'input',
                'props' => ['type' => 'number', 'name' => 'age', 'placeholder' => 'Age'],
            ],
            [
                'id' => 'age',
                'label' => 'Age',
                'width' => 50,
                'height' => 1,
                'tag' => 'input',
                'props' => ['type' => 'number', 'name' => 'age', 'placeholder' => 'Age'],
            ],
            [
                'id' => 'age',
                'label' => 'Age',
                'width' => 80,
                'height' => 1,
                'tag' => 'input',
                'props' => ['type' => 'number', 'name' => 'age', 'placeholder' => 'Age'],
            ],
        ];
    }
}
