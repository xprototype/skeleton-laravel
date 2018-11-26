<?php

namespace App\Http\Controllers\Resource;

use Genesis\Model\Prototype;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Trait ViewForm
 * @package App\Http\Controllers\Resource
 */
trait ViewForm
{
    /**
     * @param string $domain
     * @param string $scope
     * @param array $form
     * @param mixed $record
     * @return Factory|View
     */
    public function form(string $domain, string $scope, array $form, $record = null)
    {
        /** @var Prototype $prototype */
        $prototype = $this->prototype();

        $icon = $prototype->getIcon();
        $title = $prototype->getScope($scope);
        $fields = $prototype->getFields($scope);
        $actions = $prototype->getActions($scope);

        $data = [
            'domain' => $domain,
            'icon' => $icon,
            'title' => $title,
            'form' => $form,
            'fields' => $fields,
            'actions' => $actions,
            'record' => $record,
        ];
        return view("{$domain}.{$scope}", $data);
    }
}
