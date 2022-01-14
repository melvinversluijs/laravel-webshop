<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Livewire\Livewire;

use function it;
use function Pest\Laravel\actingAs;
use function uses;

uses(RefreshDatabase::class);

it('can log out other browser sessions', function () {
    actingAs(User::factory()->createOne());
    Livewire::test(LogoutOtherBrowserSessionsForm::class)
        ->set('password', 'password')
        ->call('logoutOtherBrowserSessions');
});
