<?php

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'delete any post']);
        Permission::create(['name' => 'delete any comment']);
        Permission::create(['name' => 'crud own post']);
        Permission::create(['name' => 'comment on post']);

        // Admin
        $role = Role::create(['name' => UserRolesEnum::Admin->title()]);
        $role->givePermissionTo('delete any post');
        $role->givePermissionTo('delete any comment');

        // Editor
        $role = Role::create(['name' => UserRolesEnum::Editor->title()]);
        $role->givePermissionTo('crud own post');

        // User
        $role = Role::create(['name' => UserRolesEnum::User->title()]);
        $role->givePermissionTo('comment on post');
    }
}
