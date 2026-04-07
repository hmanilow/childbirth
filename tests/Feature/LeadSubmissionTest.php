<?php

namespace Tests\Feature;

use App\Livewire\LeadForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LeadSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_api_can_store_lead(): void
    {
        $response = $this->postJson('/api/v1/leads', [
            'name' => 'Anna',
            'phone' => '+79990000000',
            'source' => 'test',
            'message' => 'I want a consultation',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('leads', [
            'phone' => '+79990000000',
            'status' => 'new',
        ]);
    }

    public function test_livewire_public_form_can_store_lead(): void
    {
        Livewire::test(LeadForm::class, ['source' => 'test_public_form'])
            ->set('name', 'Anna')
            ->set('phone', '+79990000001')
            ->set('message', 'I want to book a consultation')
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('leads', [
            'phone' => '+79990000001',
            'source' => 'test_public_form',
            'status' => 'new',
        ]);
    }
}
