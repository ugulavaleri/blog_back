<?php

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123123123'),
        ]);
        $adminUser->assignRole(UserRolesEnum::Admin->title());

        // Editor
        $editorUser = User::create([
            'name' => 'Editor User',
            'email' => 'editor@editor.com',
            'password' => bcrypt('123123123'),
        ]);
        $editorUser->assignRole(UserRolesEnum::Editor->title());

        // User
        $viewerUser = User::create([
            'name' => 'Viewer User',
            'email' => 'user@user.com',
            'password' => bcrypt('123123123'),
        ]);
        $viewerUser->assignRole(UserRolesEnum::User->title());
    }
}
