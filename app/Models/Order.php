<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable=[
          'user_id',
            'total_price',
            'transaction_id',
            'code',
            'status',
           'gateway'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function details()
     {
        return $this->hasMany(OrderDetail::class);
     }
}
