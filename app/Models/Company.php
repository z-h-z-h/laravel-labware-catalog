<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'description'
    ];


    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function sets(): HasMany
    {
        return $this->hasMany(Set::class);
    }

}

