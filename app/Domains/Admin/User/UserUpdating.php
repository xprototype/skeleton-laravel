<?php

namespace App\Domains\Admin\User;

use App\Domains\Admin\User;
use App\Exceptions\ErrorValidation;

/**
 * Class UserUpdating
 * @package App\Domains\Admin\User
 */
class UserUpdating extends UserBefore
{
    /**
     * UserBefore constructor.
     * @param User $user
     * @throws ErrorValidation
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
