<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    protected $table = 'opportunity';
    protected $primaryKey = 'id';

    public function category() {
        return $this->belongsTo(Category::class, 'id');
    }

    public function application() {
        return $this->hasMany(Application::class, 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id')->where('usertype','company');
    }

}
