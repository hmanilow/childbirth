<?php

namespace App\Domain\Leads\Policies;

use App\Domain\Leads\Models\Lead;
use App\Domain\Users\Models\User;

class LeadPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('leads.manage');
    }

    public function view(User $user, Lead $lead): bool
    {
        return $user->can('leads.manage');
    }

    public function manage(User $user): bool
    {
        return $user->can('leads.manage');
    }

    public function create(User $user): bool
    {
        return $this->manage($user);
    }

    public function update(User $user, Lead $lead): bool
    {
        return $this->manage($user);
    }

    public function delete(User $user, Lead $lead): bool
    {
        return $this->manage($user);
    }
}
