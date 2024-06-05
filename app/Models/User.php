<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Laravel\Sanctum\HasApiTokens;

class User extends AuthenticatableUser
{
    use HasApiTokens, HasFactory;

    protected $table = 'user';

    protected $primaryKey = 'id';

    protected $fillable = [
        'usertype',
        'name',
        'email',
        'password',
        'phone_number',
        'category',
    ];

    protected $hidden = [
        'password',
    ];

    public function application(): HasMany
    {
        return $this->hasMany(Application::class, 'id');
    }

    public function opportunity(): HasMany
    {
        return $this->hasMany(Opportunity::class, 'id');
    }
}
