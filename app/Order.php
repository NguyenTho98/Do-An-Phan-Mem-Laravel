<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function orderdetails()
    {
        return $this->hasMany('App\OrderDetail');
    }
}
