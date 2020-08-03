<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $fillable = ['name'];

    public function importproducts()
    {
        return $this->hasMany('App\ImportProduct');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
