<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected $dates = [
        'published_at',
    ];

    public function getPublishedAtDiffAttribute()
    {
        return Carbon::parse($this->published_at)->format('Y M, d');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function application(): HasMany
    {
        return $this->hasMany(Application::class, 'opp_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
