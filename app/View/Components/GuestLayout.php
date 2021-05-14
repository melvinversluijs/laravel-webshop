<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\Component;

class GuestLayout extends Component
{
    public function render(): View
    {
        return ViewFacade::make('layouts.guest');
    }
}
