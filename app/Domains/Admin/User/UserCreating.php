<?php

namespace App\Domains\Admin\User;

use App\Domains\Admin\User;
use App\Exceptions\ErrorValidation;
use function App\Helper\uuid;

/**
 * Class UserCreating
 * @package App\Domains\Admin\User
 */
class UserCreating extends UserBefore
{
    /**
     * UserBefore constructor.
     * @param User $user
     * @throws ErrorValidation
     */
    public function __construct(User $user)
    {
        parent::__construct($user);

        if (!$user->uuid) {
            $user->remember_token = uuid();
        }

        $this->validateDuplicatedEmail($user);
    }

    /**
     * @param User $user
     * @throws ErrorValidation
     */
    private function validateDuplicatedEmail(User $user)
    {
        $model = $user->where('email', $user->email);
        if ($user->uuid) {
            $model = $model->where('uuid', '<>', $user->uuid);
        }
        /** @noinspection PhpUndefinedMethodInspection */
        if ($model->withTrashed()->count()) {
            throw new ErrorValidation(['email' => 'duplicated'], "User '{$user->email}' already exists");
        }
    }
}
