<?php

namespace App\Livewire;

use App\Domain\Leads\Actions\CreateLeadAction;
use App\Domain\Leads\DTO\LeadData;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LeadForm extends Component
{
    #[Validate('nullable|string|max:255')]
    public ?string $name = null;

    #[Validate('required_without:email|nullable|string|max:50')]
    public ?string $phone = null;

    #[Validate('required_without:phone|nullable|email|max:255')]
    public ?string $email = null;

    #[Validate('nullable|string|max:255')]
    public ?string $city = null;

    #[Validate('nullable|string|max:5000')]
    public ?string $message = null;

    public string $source = 'public_form';

    public ?string $website = null;

    public function submit(CreateLeadAction $createLead): void
    {
        if ($this->website) {
            return;
        }

        $validated = $this->validate();

        $createLead->execute(new LeadData(
            name: $validated['name'] ?? null,
            phone: $validated['phone'] ?? null,
            email: $validated['email'] ?? null,
            city: $validated['city'] ?? null,
            message: $validated['message'] ?? null,
            source: $this->source,
            pageUrl: request()->fullUrl(),
            referer: request()->headers->get('referer'),
            payload: $validated,
        ));

        $this->reset(['name', 'phone', 'email', 'city', 'message']);
        session()->flash('status', 'Спасибо! Мы получили заявку и скоро свяжемся с вами.');
    }

    public function render()
    {
        return view('livewire.lead-form');
    }
}
