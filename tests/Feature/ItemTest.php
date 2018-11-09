<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItem()
    {
        $response = $this->json('GET', 'api/item', []);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => '90192182-2f83-40cb-b324-ce4a43dd0024',
                'name' => 'Udang 200g',
                'tax' => 5,
                'price' => 13.5504
            ]);

    }
}
