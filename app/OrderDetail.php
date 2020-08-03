<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $table = 'orderdetails';
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function productkey()
    {
        return $this->belongsTo('App\ProductKey');
    }
}
