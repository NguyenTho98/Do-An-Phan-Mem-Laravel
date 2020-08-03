<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    protected $table = 'recharges';

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
