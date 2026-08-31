<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles=[
            [
                'name'=>'admin',
                'title'=>'مدیر ارشد'
            ],
             [
                'name'=>'manger',
                'title'=>'مدیر'
            ],
             [
                'name'=>'moderator',
                'title'=>'ناظر'
            ],
             [
                'name'=>'support',
                'title'=>'پشتیبان'
            ],
             [
                'name'=>'user',
                'title'=>'کاربر عادی'
            ],
            [
                'name'=>'banned',
                'title'=>'مسدود'
            ],
        ];

        foreach($roles as $role)
            {
                Role::query()->updateOrCreate(
                        [
                            'name'=>$role['name']
                        ],
                        [
                            'title'=>$role['title']
                        ]
                    );

        
            }
        

    }
}
