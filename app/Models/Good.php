<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Good extends Model
{
    use HasTags;

    /**
     * @var array $fillable
     */
    protected $fillable = ['title', 'description', 'price', 'category_id'];

    /**
     * Category relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
