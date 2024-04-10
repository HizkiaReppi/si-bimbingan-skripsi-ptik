<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ErrorLayout extends Component
{
    public function __construct(public $title = null)
    {
        //
    }
    
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.error');
    }
}
