<?php

namespace App\Http\Controllers\Resource;

use Genesis\Model\Prototype;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Throwable;

/**
 * Trait Update
 * @package App\Http\Controllers\Resource
 */
trait ActionUpdate
{
    /**
     * @param string $id
     * @return Factory|View
     */
    public function update(string $id)
    {
        /** @var Prototype $prototype */
        $prototype = $this->prototype();

        $domain = $prototype->domain();
        $attributes = request()->all();

        /** @noinspection PhpUndefinedMethodInspection */
        $record = $prototype->find($id);
        if (is_null($record)) {
            return view('error.not-found', ['id' => $id]);
        }

        try {
            $record->fill($attributes)->save();
        } catch (Throwable $exception) {
            $scope = 'add';
            $form = [
                'method' => 'PUT',
                'action' => route("{$domain}.update"),
                'type' => 'fail',
                'message' => $exception->getMessage()
            ];
            return $this->form($domain, $scope, $form, $record);
        }

        $scope = 'index';
        $table = [
            'type' => 'success',
            'message' => 'update.success',
        ];
        return $this->table($domain, $scope, $table);
    }
}
