<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin=Role::query()->where('name','admin')->first();
        $manager=Role::query()->where('name','manger')->first();
        $moderator=Role::query()->where('name','moderator')->first();
        $support=Role::query()->where('name','support')->first();
        $user=Role::query()->where('name','user')->first();

        $permissions=Permission::query()->pluck('id','name');

        //Admin ->همه دسترسی ها
        $admin->permissions()->sync($permissions->values());

        //manager
        $manager->permissions()->sync([

             $permissions['users.view'],
             $permissions['users.edit'],

             $permissions['ads.view'],
             $permissions['ads.approve'],

              $permissions['categories.view'],
            $permissions['categories.create'],
            $permissions['categories.edit'],
            $permissions['categories.delete'],

            $permissions['cities.view'],
            $permissions['cities.create'],
            $permissions['cities.edit'],
            $permissions['cities.delete'],
        ]
           
        );

        // Moderator
        $moderator->permissions()->sync([
            $permissions['ads.view'],
            $permissions['ads.approve'],
            $permissions['ads.reject'],
        ]);

        // Support
        $support->permissions()->sync([
            $permissions['users.view'],
            $permissions['messages.view'],
        ]);

        // User
        $user->permissions()->sync([]);

    }
}
