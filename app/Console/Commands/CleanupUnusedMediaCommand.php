<?php

namespace App\Console\Commands;

use App\Domain\Media\Actions\CleanupUnusedMediaAction;
use Illuminate\Console\Command;

class CleanupUnusedMediaCommand extends Command
{
    protected $signature = 'media:cleanup-unused';
    protected $description = 'Delete media records whose model no longer exists.';

    public function handle(CleanupUnusedMediaAction $cleanupUnusedMedia): int
    {
        $count = $cleanupUnusedMedia->execute();
        $this->info("Deleted {$count} unused media records.");

        return self::SUCCESS;
    }
}
