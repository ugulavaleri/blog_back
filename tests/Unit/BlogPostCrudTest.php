<?php

namespace Tests\Unit;

use App\Models\BlogPost;
use App\Models\User;
use Tests\TestCase;

class BlogPostCrudTest extends TestCase
{
    /** @test */
    public function user_can_create_a_blog_post()
    {
        $user = User::factory()->create();
        $user->assignRole('Admin');
        $this->actingAs($user);

        $postData = [
            'title' => 'Test Post Title',
            'body' => 'Test content of the blog post.',
        ];

        $response = $this->postJson(route('blogPosts.store'), $postData);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'blog post created successfully!'
            ]);

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Test Post Title',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function user_can_edit_a_blog_post()
    {
        $user = User::factory()->create();
        $user->assignRole('Admin');
        $this->actingAs($user);

        $blogPost = BlogPost::create([
            'title' =>'test title 1',
            'body' =>'test body 1',
            'user_id' => $user->id,
        ]);

        $updatedData = [
            'title' => 'Updated Title',
            'body' => 'Updated content.',
        ];

        $response = $this->putJson(route('blogPosts.update', $blogPost->id), $updatedData);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Blog post updated successfully!'
            ]);

        $this->assertDatabaseHas('blog_posts', [
            'id' => $blogPost->id,
            'title' => 'Updated Title',
        ]);
    }

    /** @test */
    public function user_can_delete_a_blog_post()
    {
        $user = User::factory()->create();
        $user->assignRole('Admin');
        $this->actingAs($user);

        $blogPost = BlogPost::create([
            'title' =>'test title 1',
            'body' =>'test body 1',
            'user_id' => $user->id,
        ]);

        $response = $this->deleteJson(route('blogPosts.destroy', $blogPost->id));

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'blog post removed successfully!'
            ]);
    }
}
