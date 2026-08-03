<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $cities=[
         'تهران'=>['تهران','ورامین','شهریار'],
            'خراسان رضوی'=>['مشهد','نیشابور','بردسکن','کاشمر','سبزوار','باخرز','کوهسرخ','خلیل آباد','قوچان'],
            'فارس'=>['شیراز','آباده','کازرون','مرودشت','لار'],
            'کرمانشاه'=>['کرمانشاه','سنقر','پاوه','قصرشیرین','سرپل ذهاب','جوانرود','دالاهو'],
            'یزد'=>['یزد','اردکان','ابرکوه','بافق',' تفت','اشکذر','بهاباد'],
            'کرمان'=>['کرمان','سیرجان','کهنوج','بم','جیرفت','زرند','رفسنجان'],
            'گلستان'=>['گنبد کاووس','آزادشهر','مینودشت','کلاله','گرگان','آق قلا','جوانرود','علی‌آباد'],
            'مازندران'=>['ساری','بابل','آمل','قائم‌شهر','چالوس', 'بهشهر','رامسر','تنکابن', 'محمودآباد','جویبار','کلاردشت']
            
       ];

       foreach($cities as $provinceName=>$cityNames)
       {
        $province=Province::query()->where('title',$provinceName)->first();
        
        foreach($cityNames as $city)
        {
            City::query()->create([
                'city'=>$city,
               'province_id'=>$province->id
            ]);
        }
       }
    }
}
