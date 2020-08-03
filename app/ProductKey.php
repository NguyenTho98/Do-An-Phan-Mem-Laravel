<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductKey extends Model
{
    //
    protected $table = 'productkeys';

    public function importproduct()
    {
        return $this->belongsTo('App\ImportProduct');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}
