<?php

namespace App\Domain\Media\Actions;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CleanupUnusedMediaAction
{
    public function execute(): int
    {
        $deleted = 0;

        foreach (Media::query()->cursor() as $media) {
            if ($media->model) {
                continue;
            }

            $media->delete();
            $deleted++;
        }

        return $deleted;
    }
}
