<?php

namespace App\Domains\Admin\User;

use App\Domains\Admin\User;
use App\Domains\Mail\MailModel;
use App\Exceptions\ErrorValidation;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

/**
 * Class UserCreated
 * @package App\Domains\Admin\User
 */
class UserCreated
{
    /**
     * UserBefore constructor.
     * @param User $user
     * @throws ErrorValidation
     */
    public function __construct(User $user)
    {
        $user->activation_link = env('APP_CLIENT') . "/auth/confirm/{$user->remember_token}";

        $subject = Lang::trans('admin/user/created.message.subject');
        $action = Lang::trans('admin/user/created.message.action');

        $parameters = [
            'template' => 'admin.user.created',
            'data' => (object)[
                'email' => $user->email,
                'name' => $user->name,
                'activation_link' => $user->activation_link,
                'subject' => $subject,
                'action' => $action,
            ],
        ];

        $mail = MailModel::instance($parameters)
            ->subject($subject)
            ->onQueue('email');

        Mail::to($user->email)->queue($mail);
    }
}
