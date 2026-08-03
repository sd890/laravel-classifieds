<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $fillable=[
        'address',
        'postal_code',
        'latitude',
        'longitude',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
