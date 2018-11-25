<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class Controller extends BaseController
{
    /**
     * @see AuthorizesRequests
     * @see DispatchesJobs
     * @see ValidatesRequests
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
