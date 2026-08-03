<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Ad;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
       'username',
        'mobile',
        'is_phone_verified',
        'is_admin',
        'role',
        'status',
        'national_code',  //کد ملی
         'bio',
         'image',	
        'city_id',
        'email_verify'
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function city()
    {
        return $this->belongsTo(city::class);
    }
    public function addresses()
    {
        return $this->HasMany(address::class);
    }
    public function Ads()
    {
        return $this->hasMany(Ad::class);
    }


    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Ad::class,'favorites')->withTimestamps();
    }
    
     static public function saveImage($file)
   {
     if($file)
     {
          $name=time().'.'.$file->extension();

           //////////////////تعریف مسیر/////////////
           $pathSmall=public_path('images/user/smallImages/'.$name);
           $pathBig=public_path('images/user/bigImages/'.$name);

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
