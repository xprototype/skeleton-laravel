<?php

namespace App\Domains\Admin\PasswordReset;

use App\Domains\Admin\PasswordReset;
use App\Domains\Mail\MailModel;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

/**
 * Class PasswordResetCreated
 * @package App\Domains\Admin\User
 */
class PasswordResetCreated
{
    /**
     * UserBefore constructor.
     * @param PasswordReset $passwordReset
     */
    public function __construct(PasswordReset $passwordReset)
    {
        $passwordReset->reset_link = env('APP_CLIENT') . "/auth/reset/{$passwordReset->token}";

        $subject = Lang::trans('admin/user/reset.message.subject');
        $action = Lang::trans('admin/user/reset.message.action');

        $parameters = [
            'template' => 'admin.user.reset',
            'data' => (object)[
                'email' => $passwordReset->email,
                'reset_link' => $passwordReset->reset_link,
                'subject' => $subject,
                'action' => $action,
            ],
        ];

        $mail = MailModel::instance($parameters)
            ->subject($subject)
            ->onQueue('email');

        Mail::to($passwordReset->email)->queue($mail);
    }
}
