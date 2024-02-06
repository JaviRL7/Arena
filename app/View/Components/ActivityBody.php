<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActivityBody extends Component
{
    public $body;

    public function __construct($body)
    {
        $this->body = $body;
    }

    public function render()
    {
        return view('components.activity-body');
    }
}
