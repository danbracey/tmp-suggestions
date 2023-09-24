<?php

namespace App\View\Components\Tables;

use App\Models\Suggestion;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class Suggestions extends Component
{
    /**
     * Create a new component instance.
     */

    public mixed $suggestions;

    public function __construct($suggestions) {
        $this->suggestions = $suggestions;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tables.suggestions');
    }
}
