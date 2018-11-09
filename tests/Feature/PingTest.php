<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPing()
    {
        $response = $this->json('GET', 'api/ping', []);

        $response
            ->assertStatus(200)
            ->assertJson([
                'ping' => 'pong',
            ]);

    }

    public function testPingOnPostRequest()
    {
        $response = $this->json('POST', 'api/ping', []);

        $response
            ->assertStatus(500);

    }
}
