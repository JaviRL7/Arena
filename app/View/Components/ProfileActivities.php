<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProfileActivities extends Component
{
    public $activities;

    public function __construct($activities)
    {
        $this->activities = $activities;
    }

    public function render()
    {
        return view('components.profile-activities');
    }
}
