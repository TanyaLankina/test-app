<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = [
        'parent_id',
        'name',
        'order'
    ];

    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
