<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    use HasFactory;
   protected $fillable=[
        'title',
        'slug',
        'short_desc',
        'description',
        'image',
        'user_id',
        'price',
        'status',
        'is_featured',
        'views',
        'price_type',
        'expired_at',
        'category_id',
        'city_id',
        'contact_number',
            
   ];

   public function city()
   {
    return $this->belongsTo(City::class);
   }
   public function user()
   {
    return $this->belongsTo(user::class);
   }

   public function category()
   {
    return $this->belongsTo(Category::class);
   }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

     public function favorites()
     {
        return $this->belongsToMany(User::class,'favorites')->withTimestamps();
     }
   static public function saveImage($file)
   {
     if($file)
     {
          $name=time().'.'.$file->extension();

           //////////////////تعریف مسیر/////////////
           $pathSmall=public_path('images/Ads/smallImages/'.$name);
           $pathBig=public_path('images/Ads/bigImage/'.$name);

           // ایجاد دایرکتوری‌ها در صورت عدم وجود
            if (!file_exists(dirname($pathSmall))) {
                mkdir(dirname($pathSmall), 0755, true);
            }
    
            if (!file_exists(dirname($pathBig))) {
                mkdir(dirname($pathBig), 0755, true);
            }
            // پردازش و ذخیره تصویر کوچک
            $image = imagecreatefromstring(file_get_contents($file->getRealPath()));
            $smallImage = imagescale($image, 128, 128); // تغییر اندازه
            imagejpeg($smallImage, $pathSmall, 90); // ذخیره تصویر با کیفیت 90


            // ذخیره تصویر اصلی (بدون تغییر اندازه)
            move_uploaded_file($file->getRealPath(), $pathBig);

             imagedestroy($image);
            imagedestroy($smallImage);
    
            return $name;
     }
     else {
            return '';
        }
   }
}
