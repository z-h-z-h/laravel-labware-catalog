<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $fillable = ['slug', 'title', 'description', 'category_id', 'company_id'];

    public function company()
    {
        return $this()->belongsTo('App\Company');
    }

    public function category()
    {
        return $this()->belongsTo('App\Category');
    }
}
