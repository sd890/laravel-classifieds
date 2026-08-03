<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable=[
         'order_id',
           'ad_id',
           'price',
           'count',
          'status'
         
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
