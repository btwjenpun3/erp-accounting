<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BreadcrumbComponent extends Component
{
    public array $segments;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $url = request()->path();
        $this->segments = explode('/', $url);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrumb-component', [
            'segments' => $this->segments,
        ]);
    }
}
