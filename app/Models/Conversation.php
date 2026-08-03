<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable=[
        'user_one_id',
        'user_two_id',
        'last_message_id',

    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function userOne()
    {
        return $this->belongsTo(User::class,'user_one_id');
    }
     public function userTwo()
     {
        return $this->belongsTo(User::class,'user_two_id');
     }

     // متد کمکی برای پیدا کردن گفت‌وگو بین دو کاربر
    public static function between($userId, $otherId)
    {
        return self::where(function($q) use ($userId, $otherId) {
            $q->where('user_one_id', $userId)->where('user_two_id', $otherId);
        })->orWhere(function($q) use ($userId, $otherId) {
            $q->where('user_one_id', $otherId)->where('user_two_id', $userId);
        });
    }
}
