<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class loginTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginWithCorrectCredentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'password'),
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function testLoginWithIncorrectCredentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('password'),
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'mal-password',
        ]);
        $response->assertRedirect('/');
    }

    public function testUserWillSeeHomepageWhenLoggedIn()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
    }

}
