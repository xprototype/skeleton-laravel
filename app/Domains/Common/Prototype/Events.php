<?php
namespace App\Domains\Common\Prototype;

use App\Domains\Common\Prototype;

/**
 * Trait Events
 * @package App\Domains\Common\Prototype
 */
trait Events
{
    /**
     * @param string $event
     * @param string $action
     * @return Prototype
     */
    protected function event(string $event, string $action): Prototype
    {
        $this->dispatchesEvents[$event] = $action;

        /** @var Prototype $this */
        return $this;
    }
}
