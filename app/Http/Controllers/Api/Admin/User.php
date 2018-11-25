<?php

namespace App\Http\Controllers\Api\Admin;

use App\Domains\Admin\User\UserRepository;
use App\Http\Controllers\Api\CrudController;
use Illuminate\Http\Request;

/**
 * Class User
 * @package App\Http\Controllers\Api\Admin
 */
class User extends CrudController
{
    /**
     * User constructor.
     * @param UserRepository $repository
     * @param Request $request
     */
    public function __construct(UserRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}
