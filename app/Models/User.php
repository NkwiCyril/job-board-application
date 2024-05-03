<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;


class User extends AuthenticatableUser
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'usertype',
        'name',
        'email',
        'password',
        'phone_number',
        'category'
    ];
    protected $hidden = [
        'password'
    ];

    public function application() {
        return $this->hasMany(Application::class, 'id')->where('usertype','seeker');
    }

    public function opportunity() {
        return $this->hasMany(Opportunity::class, 'id')->where('usertype','company');
    }
}
