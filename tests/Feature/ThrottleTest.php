<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThrottleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
/*         for ($i=0; $i < 1000; $i++) {
            # code...
            $response = $this->actingAs($this->user)->get('/user/profile');
        }
        $response->assertStatus(429); */
        //dd($response->status());

        $response = $this->get('/');
        $response->assertRedirect('/en');
    }
}
