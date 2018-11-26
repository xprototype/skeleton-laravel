<?php

namespace App\Domains\Common\Prototype;

/**
 * Trait Keys
 * @package App\Domains\Common\Prototype
 */
trait Keys
{
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
}
