<?php

namespace App\Domains\Admin;

use App\Domains\Admin\User\UserCreated;
use App\Domains\Admin\User\UserCreating;
use App\Domains\Admin\User\UserUpdating;
use App\Domains\Common\Model;
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
class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'firstName',
        'lastName',
        'birthday',
        'gender',
        // 'password',
        'photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'uuid',
        'password',
        'remember_token',
        'deleted_at',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => UserCreating::class,
        'created' => UserCreated::class,
        'updating' => UserUpdating::class,
    ];

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
