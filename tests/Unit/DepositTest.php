<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepositTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCannotDepositNegativeAmount()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user)->post('/depositar', [
            'monto' => -1000,
        ]);

        $user = $user->fresh();

        $this->assertEquals(0, $user->balance);
    }

    public function testUserCanDeposit()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john2@example.com',
            'password' => bcrypt('secret'),
            'balance' => 1000
        ]);

        $this->actingAs($user)->post('/depositar', [
            'monto' => 1000,
        ]);

        $user = $user->fresh();

        $this->assertEquals(2000, $user->balance);

    }
}
