<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommentDisplay extends Component
{
    public $comments;

    public function __construct($comments)
    {
        $this->comments = $comments;
    }

    public function render()
    {
        return view('components.comment-display');
    }
}
