<?php

namespace App\Domains\Admin\User;

use App\Domains\Admin\PasswordReset;
use App\Domains\Admin\User;
use App\Domains\Common\Prototype;
use App\Domains\Common\Repository;
use Illuminate\Support\Facades\Hash;
use function App\Helper\uuid;

/**
 * Class UserRepository
 * @package App\Domains\Admin\User
 */
class UserRepository extends Repository
{
    /**
     * User constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * @param string $email
     * @return Prototype|null
     */
    public function findByEmail(string $email)
    {
        return $this->read(['email' => $email])->first();
    }

    /**
     * @param string $code
     * @return Prototype|null
     */
    public function findByRememberToken(string $code)
    {
        return $this->read(['remember_token' => $code])->first();
    }

    /**
     * @param string $token
     * @return Prototype|null
     */
    public function findByResetToken(string $token)
    {
        $resetPassword = $this->getResetPassword($token);
        if (!$resetPassword) {
            return null;
        }
        return $this->findByEmail($resetPassword->email);
    }

    /**
     * @param string $email
     * @return bool
     */
    public function createResetPassword(string $email)
    {
        $token = uuid();
        $data = [
            'email' => $email,
            'token' => $token,
        ];
        return PasswordReset::instance()->fill($data)->save();
    }

    /**
     * @param string $token
     * @return PasswordReset|null
     */
    public function getResetPassword(string $token)
    {
        return PasswordReset::instance()->where('token', $token)->get(['email'])->first();
    }

    /**
     * @param string $token
     * @param string $password
     * @return bool
     */
    public function destroyResetPassword(string $token, string $password)
    {
        $passwordReset = PasswordReset::instance()->where('token', $token)->get()->first();
        $passwordReset->password = Hash::make($password);
        $passwordReset->deleted_at = now();
        return $passwordReset->save();
    }
}
