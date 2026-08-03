<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   protected $fillable=[
    'user_id',
    'ad_id',
    'image'
   ];

   public function user()
   {
    return $this->belongsTo(User::class,'user_id');
   }

   public function ad()
   {
    return $this->belongsTo(Ad::class,'ad_id');
   }
}
