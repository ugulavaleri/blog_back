<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        for ($i = 0;$i < 20;$i++){
            $user = $users->random();
            BlogPost::create([
                'title' => 'Blog Post' . $i,
                'body' => 'Blog Post Body' . $i,
                'user_id' =>$user->id
            ]);
        }
    }
}
