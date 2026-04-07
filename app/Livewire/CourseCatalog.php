<?php

namespace App\Livewire;

use App\Domain\Courses\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseCatalog extends Component
{
    use WithPagination;

    public ?string $search = null;

    public function render()
    {
        return view('livewire.course-catalog', [
            'courses' => Course::query()
                ->published()
                ->when($this->search, fn ($query) => $query->where('title', 'like', '%'.$this->search.'%'))
                ->orderBy('sort_order')
                ->paginate(12),
        ]);
    }
}
