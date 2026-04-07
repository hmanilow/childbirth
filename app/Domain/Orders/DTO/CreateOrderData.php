<?php

namespace App\Domain\Orders\DTO;

use App\Domain\Courses\Models\Course;
use App\Domain\Users\Models\User;

final readonly class CreateOrderData
{
    public function __construct(
        public Course $course,
        public ?User $user,
        public string $customerName,
        public string $customerPhone,
        public ?string $customerEmail = null,
        public ?int $leadId = null,
        public ?array $metadata = null,
    ) {
    }
}
