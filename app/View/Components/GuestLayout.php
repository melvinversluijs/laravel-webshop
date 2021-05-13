<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    public function render(): View
    {
        return ViewFacade::make('layouts.guest');
    }
}
