<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\Rules\Exists;

class Category extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'image',
        'parent_id'
    ];
    public function Ads()
    {
        return $this->hasMany(Ad::class);
    }

    public static function saveImage($file)
    {
        if($file)
        {
            $name = time() . '.' . $file->extension();

            //////////////////تعریف مسیر/////////////

            $pathSmall=public_path('images/category/smallImages/'.$name);
            $pathBig=public_path('images/category/bigImages/'.$name);

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

            // آزادسازی حافظه
            imagedestroy($image);
            imagedestroy($smallImage);
    
            return $name;
        }
        else {
            return '';
        }
    }

    public static function storeInfo($request)
    {
        $image=self::saveImage($request->file);
        $parent_id=$request->input('parent_id')?:null;
        self::query()->create([
            'title'=>$request->input('title'),
            'image'=>$image,
            'parent_id'=>$parent_id
        ]);
    }
}
