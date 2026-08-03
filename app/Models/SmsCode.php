<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsCode extends Model
{
    protected $fillable=[
         'user_id',
         'code',
         'used',
         'attempts',
         'expires_at'
    ];
}
