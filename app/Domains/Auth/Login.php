<?php

namespace App\Domains\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\BinaryUuid\HasBinaryUuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @package App\Domains\Admin
 * @property string password
 * @property boolean active
 * @method static Login where(string $column, mixed $value)
 * @method Login firstOrFail()
 * @method Login first()
 */
class Login extends Authenticatable implements JWTSubject
{
    /**
     * @see Notifiable
     */
    use Notifiable;

    /**
     * @see HasBinaryUuid
     */
    use HasBinaryUuid;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'uuid',
        'password',
        'remember_token',
        'updated_at',
        'created_at',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the primary key for the model.
     *
     * @return string
     */
    public function getKeyName()
    {
        return 'id';
    }
}
