<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Resource\ActionDestroy;
use App\Http\Controllers\Resource\ActionStore;
use App\Http\Controllers\Resource\ActionUpdate;
use App\Http\Controllers\Resource\ViewForm;
use App\Http\Controllers\Resource\ViewTable;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class ResourceController
 * @package App\Http\Controllers
 */
class ResourceController extends PrototypeController
{
    /**
     * @trait
     */
    use ViewTable, ViewForm, ActionStore, ActionUpdate, ActionDestroy;

    /**
     * @return Factory|View
     */
    public function index()
    {
        $domain = $this->prototype()->domain();
        $scope = 'index';
        $table = [];
        return $this->table($domain, $scope, $table);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $domain = $this->prototype()->domain();
        $scope = 'add';
        $form = [
            'method' => 'POST',
            'action' => route("{$domain}.store"),
        ];
        return $this->form($domain, $scope, $form);
    }

    /**
     * @param string $id
     * @return Factory|View
     */
    public function view(string $id)
    {
        $domain = $this->prototype()->domain();
        $scope = 'view';
        $form = [];
        /** @noinspection PhpUndefinedMethodInspection */
        $record = $this->prototype()->find($id);
        if (is_null($record)) {
            return view('error.not-found', ['id' => $id]);
        }

        return $this->form($domain, $scope, $form, $record);
    }

    /**
     * @param string $id
     * @return Factory|View
     */
    public function edit(string $id)
    {
        $prototype = $this->prototype();

        $domain = $prototype->domain();
        $scope = 'add';
        $form = [
            'method' => 'PUT',
            'action' => route("{$domain}.update"),
        ];

        /** @noinspection PhpUndefinedMethodInspection */
        $record = $prototype->find($id);
        if (is_null($record)) {
            return view('error.not-found', ['id' => $id]);
        }

        return $this->form($domain, $scope, $form, $record);
    }
}
