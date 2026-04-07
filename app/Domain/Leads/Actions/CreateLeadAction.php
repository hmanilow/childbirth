<?php

namespace App\Domain\Leads\Actions;

use App\Domain\Analytics\Models\ConversionEvent;
use App\Domain\Leads\DTO\LeadData;
use App\Domain\Leads\Models\Lead;
use Illuminate\Support\Facades\DB;

class CreateLeadAction
{
    public function execute(LeadData $data): Lead
    {
        return DB::transaction(function () use ($data): Lead {
            $lead = Lead::create($data->toArray());

            ConversionEvent::create([
                'lead_id' => $lead->id,
                'type' => 'lead_created',
                'source' => $data->source,
                'utm_source' => $data->utmSource,
                'utm_medium' => $data->utmMedium,
                'utm_campaign' => $data->utmCampaign,
                'utm_content' => $data->utmContent,
                'utm_term' => $data->utmTerm,
                'page_url' => $data->pageUrl,
                'referer' => $data->referer,
                'payload' => $data->payload,
            ]);

            return $lead;
        });
    }
}
