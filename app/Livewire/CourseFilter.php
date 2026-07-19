<?php

namespace App\Livewire;

use App\Domain\Courses\Models\Course;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CourseFilter extends Component
{
    use WithPagination;

    public string $search = '';
    #[Url(except: 'online')]
    public string $format = Course::FORMAT_ONLINE;
    public string $category = '';
    public string $sort   = 'featured';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFormat(): void
    {
        $this->resetPage();
    }

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Course::published();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('short_desc', 'like', '%' . $this->search . '%');
            });
        }

        if (in_array($this->format, [Course::FORMAT_ONLINE, Course::FORMAT_OFFLINE], true)) {
            $query->where('format', $this->format);
        }

        if ($this->category !== '') {
            $query->where('category', $this->category);
        }

        $query = match ($this->sort) {
            'title'      => $query->orderBy('title'),
            'new'        => $query->orderByDesc('created_at'),
            default      => $query->orderByDesc('is_featured')->orderBy('sort_order'),
        };

        $courses = $query->paginate(18);
        $categories = Course::published()
            ->where('format', $this->format)
            ->whereNotNull('category')
            ->orderBy('category')
            ->pluck('category')
            ->unique()
            ->values();

        return view('livewire.course-filter', compact('courses', 'categories'));
    }
}
