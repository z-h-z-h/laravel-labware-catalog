<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Company extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description'
    ];

    public function sets(): HasMany
    {
        return $this->hasMany(Set::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}

