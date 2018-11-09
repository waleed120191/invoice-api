<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testInvoice()
    {
        // Hardcoded as testing from CSV data, Whereas it can be made dynamic using seeders for DB data.
        $request = [
            'lines' => [
                [
                    'id' => 'c2f5b5b6-d85d-41bb-9651-bea30cc880b0',
                    'quantity' => 2,
                    'discount' => 50
                ],
                [
                    'id' => 'c2f5b5b6-d85d-41bb-9651-bea30cc880b0',
                    'quantity' => 2,
                    'discount' => 50
                ]


            ]
        ];

        $response = $this->json('POST', 'api/invoice', $request);

        // Hardcoded as testing from CSV data.
        $response_lines = [
            [
                'id' => 'c2f5b5b6-d85d-41bb-9651-bea30cc880b0',
                'name' => 'Udang 200g',
                'quantity' => 2,
                'discount' => 50,
                "tax_rate"=> 5,
                "total"=> 13.5504
            ],
            [
                'id' => 'c2f5b5b6-d85d-41bb-9651-bea30cc880b0',
                'name' => 'Udang 200g',
                'quantity' => 2,
                'discount' => 50,
                "tax_rate"=> 5,
                "total"=> 13.5504
            ]
        ];

        $response
            ->assertStatus(200)
            ->assertJson
            (['lines' => $response_lines , 'tax' => 10, 'total' => 37.1008]);

    }
}
