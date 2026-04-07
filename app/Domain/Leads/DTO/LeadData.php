<?php

namespace App\Domain\Leads\DTO;

use App\Domain\Leads\Enums\LeadStatus;

final readonly class LeadData
{
    public function __construct(
        public ?string $name,
        public ?string $phone,
        public ?string $email,
        public ?string $city,
        public ?string $message,
        public string $source,
        public ?string $utmSource = null,
        public ?string $utmMedium = null,
        public ?string $utmCampaign = null,
        public ?string $utmContent = null,
        public ?string $utmTerm = null,
        public ?string $pageUrl = null,
        public ?string $referer = null,
        public LeadStatus $status = LeadStatus::New,
        public ?array $payload = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'city' => $this->city,
            'message' => $this->message,
            'source' => $this->source,
            'utm_source' => $this->utmSource,
            'utm_medium' => $this->utmMedium,
            'utm_campaign' => $this->utmCampaign,
            'utm_content' => $this->utmContent,
            'utm_term' => $this->utmTerm,
            'page_url' => $this->pageUrl,
            'referer' => $this->referer,
            'status' => $this->status,
            'payload' => $this->payload,
        ];
    }
}
