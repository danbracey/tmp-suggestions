<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ManageSuggestion extends Component
{
    public $suggestion;

    /**
     * Create a new component instance.
     */
    public function __construct($suggestion)
    {
        $this->suggestion = $suggestion;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        switch($this->suggestion->status) {
            case 1:
            default:
                return view('components.suggestions.manage.unapproved');
                break;
            case 2:
                return view('components.suggestions.manage.approved');
                break;
            case 3:
                return view('components.suggestions.manage.denied');
                break;
        }
    }
}
