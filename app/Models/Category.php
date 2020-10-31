<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description',
        'parent_id',
        'company_id'
    ];

    public function company(): belongsTo
    {
        return $this->belongsTo('App\Company');
    }
}
