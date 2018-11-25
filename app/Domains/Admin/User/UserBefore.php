<?php

namespace App\Domains\Admin\User;

use App\Domains\Admin\User;
use App\Exceptions\ErrorValidation;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserBefore
 * @package App\Domains\Admin\User
 */
class UserBefore
{
    /**
     * UserBefore constructor.
     * @param User $user
     * @throws ErrorValidation
     */
    public function __construct(User $user)
    {
        if ($user->firstName && $user->lastName) {
            $user->name = "{$user->firstName} {$user->lastName}";
        }
        if ($user->password) {
            $user->password = Hash::make($user->password);
        }
    }
}
