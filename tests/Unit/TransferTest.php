<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransferTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCannotTransferIfInsuficientFunds()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john1@example.com',
            'password' => bcrypt('secret'),
            'balance' => 500
        ]);

        factory(User::class)->create([
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user)->post('/transferir', [
            'user' => 2,
            'monto' => 1000,
        ]);

        $user = $user->fresh();

        $this->assertTrue( $user->balance == 500 );
    }

    public function testUserCanTransferIfSuficientFunds()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john2@example.com',
            'password' => bcrypt('secret'),
            'balance' => 1000
        ]);

        factory(User::class)->create([
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user)->post('/transferir', [
            'user' => 2,
            'monto' => 100,
        ]);

        $user = $user->fresh();

        $this->assertTrue( $user->balance == 900 );
    }

}
