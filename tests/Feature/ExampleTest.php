<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}



/*
 *
 *
 * age. So open it now, it should look like this:
 *
 *   <?php
 *   class ExampleTest extends TestCase
 *  {
 *
 * A basic functional test example.
 *
 * @return void
 *
 * public function testBasicExample()
 * {
 *   $this->visit('/')
 *      ->see('Laravel 5.5');
 * }
 * }
 */


