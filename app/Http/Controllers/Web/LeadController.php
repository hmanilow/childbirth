<?php

namespace App\Http\Controllers\Web;

use App\Domain\Leads\Actions\CreateLeadAction;
use App\Domain\Leads\DTO\LeadData;
use App\Http\Requests\StoreLeadRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class LeadController extends Controller
{
    public function store(StoreLeadRequest $request, CreateLeadAction $createLead): RedirectResponse
    {
        $validated = $request->validated();

        $createLead->execute(new LeadData(
            name: $validated['name'] ?? null,
            phone: $validated['phone'] ?? null,
            email: $validated['email'] ?? null,
            city: $validated['city'] ?? null,
            message: $validated['message'] ?? null,
            source: $validated['source'],
            utmSource: $validated['utm_source'] ?? null,
            utmMedium: $validated['utm_medium'] ?? null,
            utmCampaign: $validated['utm_campaign'] ?? null,
            utmContent: $validated['utm_content'] ?? null,
            utmTerm: $validated['utm_term'] ?? null,
            pageUrl: $validated['page_url'] ?? $request->headers->get('referer'),
            referer: $validated['referer'] ?? $request->headers->get('referer'),
            payload: $validated,
        ));

        return back()->with('status', 'Спасибо! Мы получили заявку и скоро свяжемся с вами.');
    }
}
