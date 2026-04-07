<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_api_can_store_lead(): void
    {
        $response = $this->postJson('/api/v1/leads', [
            'name' => 'Анна',
            'phone' => '+79990000000',
            'source' => 'test',
            'message' => 'Хочу консультацию',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('leads', [
            'phone' => '+79990000000',
            'status' => 'new',
        ]);
    }
}
