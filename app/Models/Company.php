<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description'
    ];

    public function sets(): hasMany
    {
        return $this->hasMany('App\Set');
    }

    public function categories(): hasMany
    {
        return $this->hasMany('App\Category');
    }
}
