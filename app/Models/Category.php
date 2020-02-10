<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    /**
     * @var array $fillable
     */
    protected $fillable = ['name', 'description'];

    /**
     * @var array $hidden
     */
    protected $hidden = ['_lft', '_rgt'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goods()
    {
        return $this->hasMany(Good::class);
    }
}
