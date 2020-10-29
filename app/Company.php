<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable =['slug','title','description'];

    public function sets()
    {
        return $this->hasMany('App\set');
    }
    public function categories()
    {
        return $this->hasMany('App\Category');
    }
}
