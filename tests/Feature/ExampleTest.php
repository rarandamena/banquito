<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{


    public function testSeePejos()
    {
        $response =  $this->get('/');
        $response->assertSee('pejos');
    }

    public function testWrongLogin()
    {
        $response = $this->json('POST', '/login', [
            'email' => 'malusuario@mail.com',
            'password' => 'asasfasfas',
        ]);

        $response->assertStatus(422);
        $response->assertSee('Estas credenciales no coinciden con nuestros registros.');
    }
}
