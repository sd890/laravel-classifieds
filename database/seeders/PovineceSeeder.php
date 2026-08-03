<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PovineceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces=[
            'تهران',
            'خراسان رضوی',
            'فارس',
            'کرمانشاه',
            'یزد',
            'کرمان',
            'گلستان',
            'مازندران',
            'سمنان',
            'بندرعباس'
            
        ];

        foreach($provinces as $name)
        {
            Province::query()->create(
                ['title'=>$name]
            );
        }
    }
}
