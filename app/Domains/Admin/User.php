<?php

namespace App\Domains\Admin;

use App\Domains\Admin\User\UserCreated;
use App\Domains\Admin\User\UserCreating;
use App\Domains\Admin\User\UserUpdating;
use App\Domains\Common\Prototype;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class User
 * @property mixed uuid
 * @property string name
 * @property string email
 * @property string firstName
 * @property string lastName
 * @property string birthday
 * @property string gender
 * @property string password
 * @property string remember_token
 * @property boolean active
 * @property string activation_link
 * @package App\Domains\Admin
 */
class User extends Prototype
{
    /**
     * @return string
     */
    public function domain(): string
    {
        return 'admin.user';
    }

    /**
     * @return void
     */
    public function construct()
    {
        $this->event('creating', UserCreating::class);
        $this->event('created', UserCreated::class);
        $this->event('updating', UserUpdating::class);

        $this->field('email', 'Email')->email()->required();
        $this->field('firstName', 'First Name')->firstName()->required();
        $this->field('lastName', 'Last Name')->lastName()->required();

        $this->field('name')->calculated(function (Prototype $record) {
            if ($record->getValue('firstName') && $record->getValue('lastName')) {
                return "{$record->getValue('firstName')} {$record->getValue('lastName')}";
            }
            return null;
        });

        $this->field('birthday', 'Birthday')->date();
        $this->field('gender', 'Gender')->option(['m' => 'Male', 'f' => 'Female']);
        $this->field('password', 'Password')->password();
        $this->field('photo', 'Photo')->image();

        $this->field('remember_token')->string()->hidden(true);
    }

    /**
     * Get the primary key for the model.
     *
     * @return string
     */
    public function getAuthIdentifier()
    {
        return 'id';
    }
}
