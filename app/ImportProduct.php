<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportProduct extends Model
{
    protected $table = 'importproducts';

    public function publisher()
    {
        return $this->belongsTo('App\Publisher');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function productkeys()
    {
        return $this->hasMany('App\ProductKey', 'importproduct_id');
    }
}
