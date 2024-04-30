<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThrottleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
/*         for ($i=0; $i < 1000; $i++) {
            # code...
            $response = $this->get('/');
            $response->assertStatus(200);
        } */

        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
