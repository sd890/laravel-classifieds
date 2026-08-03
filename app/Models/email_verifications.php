<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class email_verifications extends Model
{
    protected $fillable=[
        'user_id',
        'email',
        'code'
    ];
}
