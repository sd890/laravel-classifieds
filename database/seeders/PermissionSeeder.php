<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=[
             // Users
            ['name' => 'users.view', 'title' => 'مشاهده کاربران'],
            ['name' => 'users.edit', 'title' => 'ویرایش کاربران'],
            ['name' => 'users.delete', 'title' => 'حذف کاربران'],

            // Ads
            ['name' => 'ads.view', 'title' => 'مشاهده آگهی‌ها'],
            ['name' => 'ads.approve', 'title' => 'تأیید آگهی'],
            ['name' => 'ads.reject', 'title' => 'رد آگهی'],
            ['name' => 'ads.delete', 'title' => 'حذف آگهی'],

            // Categories
            ['name' => 'categories.view', 'title' => 'مشاهده دسته‌بندی‌ها'],
            ['name' => 'categories.create', 'title' => 'ایجاد دسته‌بندی'],
            ['name' => 'categories.edit', 'title' => 'ویرایش دسته‌بندی'],
            ['name' => 'categories.delete', 'title' => 'حذف دسته‌بندی'],

            // Cities
            ['name' => 'cities.view', 'title' => 'مشاهده شهرها'],
            ['name' => 'cities.create', 'title' => 'ایجاد شهر'],
            ['name' => 'cities.edit', 'title' => 'ویرایش شهر'],
            ['name' => 'cities.delete', 'title' => 'حذف شهر'],

            // Messages
            ['name' => 'messages.view', 'title' => 'مشاهده پیام‌ها'],

        ];

        foreach($permissions as $permission)
            {
                Permission::query()->updateOrCreate(
                    [
                        'name'=>$permission['name']
                    ],
                    [
                        'title'=>$permission['title']    
                    ]
                );
            }
    }
}
