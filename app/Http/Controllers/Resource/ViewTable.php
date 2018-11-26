<?php

namespace App\Http\Controllers\Resource;

use Genesis\Model\Prototype;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Trait ViewTable
 * @package App\Http\Controllers\Resource
 */
trait ViewTable
{
    /**
     * @var int
     */
    protected $limit = 10;

    /**
     * @param string $domain
     * @param string $scope
     * @param array $table
     * @return Factory|View
     */
    public function table(string $domain, string $scope, array $table)
    {
        /** @var Prototype $prototype */
        $prototype = $this->prototype();

        $icon = $prototype->getIcon();
        $title = $prototype->getScope($scope);
        $fields = $prototype->getFields($scope);
        $actions = $prototype->getActions($scope);

        /** @noinspection PhpUndefinedMethodInspection */
        $records = $prototype->paginate(request()->get('limit', $this->limit));
        $data = [
            'domain' => $domain,
            'icon' => $icon,
            'title' => $title,
            'table' => $table,
            'fields' => $fields,
            'actions' => $actions,
            'records' => $records,
        ];
        return view("{$domain}.{$scope}", $data);
    }
}
