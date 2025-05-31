<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property float $balance
 * @property string $email
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 *
 * @mixin Builder<User>
 */
class User extends Authenticatable implements JWTSubject
{
    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'email',
        'type',
        'balance',
        'password',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'balance' => 'float',
            'created_at' => 'datetime:Y-m-d H:i:s',
            'updated_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


}
