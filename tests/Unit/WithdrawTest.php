<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WithdrawTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCannotWithdrawNegativeAmount()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user)->post('/retirar', [
            'monto' => -1000,
        ]);

        $user = $user->fresh();

        $this->assertEquals(0, $user->balance);
    }

    public function testUserCannotWithdrawMoreThan1000()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john2@example.com',
            'password' => bcrypt('secret'),
            'balance' => 2000
        ]);

        $response = $this->actingAs($user)->post('/retirar', [
            'monto' => 1500,
        ]);

        $user = $user->fresh();

        $this->assertTrue(count(session()->get('errors')) > 0);
        $this->assertEquals(2000, $user->balance);
    }

    public function testUserCanWithdraw()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john2@example.com',
            'password' => bcrypt('secret'),
            'balance' => 1000
        ]);

        $this->actingAs($user)->post('/retirar', [
            'monto' => 500,
        ]);

        $user = $user->fresh();

        $this->assertEquals(500, $user->balance);
    }

}
