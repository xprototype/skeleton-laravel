<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Resource\ActionDestroy;
use App\Http\Controllers\Resource\ActionStore;
use App\Http\Controllers\Resource\ActionUpdate;
use Genesis\Model\Prototype;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class PrototypeController
 * @package App\Http\Controllers
 */
class PrototypeController extends Controller
{
    /**
     * @var Prototype
     */
    private $model;

    /**
     * @var string
     */
    protected $prototype;

    /**
     * @return Prototype
     */
    protected function prototype(): Prototype
    {
        if (!$this->model) {
            $this->model = app($this->prototype);
        }
        return $this->model;
    }
}
