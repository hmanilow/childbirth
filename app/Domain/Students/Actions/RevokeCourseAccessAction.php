<?php

namespace App\Domain\Students\Actions;

use App\Domain\Students\Models\CourseAccessGrant;

class RevokeCourseAccessAction
{
    public function execute(CourseAccessGrant $grant, ?string $notes = null): CourseAccessGrant
    {
        $grant->forceFill([
            'revoked_at' => now(),
            'notes' => trim(($grant->notes ? $grant->notes.PHP_EOL : '').($notes ?? '')),
        ])->save();

        return $grant;
    }
}
