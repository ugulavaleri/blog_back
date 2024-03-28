<?php

    namespace Tests\Unit;

    use App\Models\User;
    use Tests\TestCase;

    class AuthTest extends TestCase
    {
        /** @test */
        public function a_user_can_register()
        {
            $response = $this->json('POST', '/api/user/register', [
                'name' => 'test name',
                'email' => 'test@example.com',
                'password' => 'password',
            ]);

            $response->assertStatus(200);
            $response->assertJson([
                'success' => 'User Registered Successfully!',
            ]);
            $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        }

        /** @test */
        public function a_user_can_login()
        {
            User::create([
                'name' => 'login',
                'email' => 'login@login.com',
                'password' => bcrypt('password'),
            ]);

            $response = $this->postJson('/api/user/login', [
                'name' => 'login',
                'email' => 'login@login.com',
                'password' => 'password',
            ]);

            $response
                ->assertStatus(200)
                ->assertJson(['success' => 'User Logging Successfully!']);
        }

    }
