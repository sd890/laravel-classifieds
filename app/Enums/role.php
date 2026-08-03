<?php

namespace App\Enums;

enum Role: string
{
    case User = 'user';//;کاربر عادی
    case Admin = 'admin';// مدیر ارشدر
    case Moderator = 'moderator';//ناظر که تنها نقش تایید یا رد درخواست دارد
    case Support = 'support';//پشتیبان
    case Manager = 'manager';//مدیر
    case Banned = 'banned';//مسدود سازی
}
