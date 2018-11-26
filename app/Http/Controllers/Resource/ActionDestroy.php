<?php

namespace App\Http\Controllers\Resource;

use Genesis\Model\Prototype;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Throwable;

/**
 * Trait Destroy
 * @package App\Http\Controllers\Resource
 */
trait ActionDestroy
{
    /**
     * @param string $id
     * @return Factory|View
     */
    public function destroy(string $id)
    {
        /** @var Prototype $prototype */
        $prototype = $this->prototype();

        $domain = $prototype->domain();

        /** @noinspection PhpUndefinedMethodInspection */
        $record = $prototype->find($id);
        if (is_null($record)) {
            return view('error.not-found', ['id' => $id]);
        }

        $scope = 'index';
        $table = [
            'type' => 'success',
            'message' => 'delete.success',
        ];

        try {
            /** @var Prototype $record */
            $record->delete();
        } catch (Throwable $exception) {
            $table = [
                'type' => 'fail',
                'message' => $exception->getMessage()
            ];
        }
        return $this->table($domain, $scope, $table);
    }
}
