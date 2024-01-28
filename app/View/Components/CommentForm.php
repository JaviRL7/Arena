<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommentForm extends Component
{
    public $serie;

    public function __construct($serie)
    {
        $this->serie = $serie;
    }

    public function render()
    {
        return view('components.comment-form');
    }
}
