<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Leads\Actions\CreateLeadAction;
use App\Domain\Leads\DTO\LeadData;
use App\Http\Requests\StoreLeadRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class LeadController extends Controller
{
    public function store(StoreLeadRequest $request, CreateLeadAction $createLead): JsonResponse
    {
        $validated = $request->validated();

        $lead = $createLead->execute(new LeadData(
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
            pageUrl: $validated['page_url'] ?? null,
            referer: $validated['referer'] ?? null,
            payload: $validated,
        ));

        return response()->json(['data' => ['id' => $lead->id]], 201);
    }
}
