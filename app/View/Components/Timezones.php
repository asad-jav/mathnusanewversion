<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Timezones extends Component
{
    /**
     * Create a new component instance.
     */
    public $class;
    public $id;
    public $name;

    public function __construct($name, $id, $class)
    {
        $this->name = $name;
        $this->id = $id;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.timezones');
    }
}
