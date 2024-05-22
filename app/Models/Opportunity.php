<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    protected $table = 'opportunity';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'category_id',
        'user_id',
    ];

    protected $published_at;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function application()
    {
        return $this->hasMany(Application::class, 'opp_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
