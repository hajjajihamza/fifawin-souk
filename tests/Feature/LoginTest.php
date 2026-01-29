<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful login
     */
    public function test_login(): void
    {
        User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'admin@admin.com',
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => 'password'
        ]);

        $response->assertStatus(302); // Redirection after login
        $this->assertAuthenticated();
    }

    /**
     * Test login with invalid credentials
     */
    public function test_login_with_invalid_credentials(): void
    {
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword'
        ]);

        $response->assertSessionHasErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
        $this->assertGuest();
    }

    /**
     * Test that login page is accessible
     */
    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function test_logout(): void
    {
        $response = $this->post('/logout');

        $response->assertStatus(302);
    }
}
