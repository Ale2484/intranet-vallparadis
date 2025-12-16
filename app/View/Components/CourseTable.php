<?php

namespace App\View\Components;

use Closure;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CourseTable extends Component
{
    public $course;
    /**
     * Create a new component instance.
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.course-table');
    }
}
