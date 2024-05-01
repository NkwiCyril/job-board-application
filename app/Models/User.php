<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'usertype',
        'name',
        'email',
        'password',
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
