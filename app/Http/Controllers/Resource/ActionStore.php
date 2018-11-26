<?php

namespace App\Http\Controllers\Resource;

use Genesis\Model\Prototype;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Throwable;

/**
 * Trait Store
 * @package App\Http\Controllers\Resource
 */
trait ActionStore
{
    /**
     * @return Factory|View
     */
    public function store()
    {
        /** @var Prototype $prototype */
        $prototype = $this->prototype();

        $domain = $prototype->domain();
        $attributes = request()->all();

        try {
            $prototype->fill($attributes)->save();
        } catch (Throwable $exception) {
            $scope = 'add';
            $form = [
                'method' => 'POST',
                'action' => route("{$domain}.store"),
                'type' => 'fail',
                'message' => $exception->getMessage()
            ];
            return $this->form($domain, $scope, $form, $record);
        }

        $scope = 'index';
        $table = [
            'type' => 'success',
            'message' => 'store.success',
        ];
        return $this->table($domain, $scope, $table);
    }
}
