<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;

use function it;
use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertEquals;
use function uses;

uses(RefreshDatabase::class);

it('has current profile information available', function () {
    $user = User::factory()->createOne();
    actingAs($user);
    $component = Livewire::test(UpdateProfileInformationForm::class);

    assertEquals($user->name, $component->state['name']);
    assertEquals($user->email, $component->state['email']);
});

it('can update profile information', function () {
    $user = User::factory()->createOne();
    actingAs($user);
    Livewire::test(UpdateProfileInformationForm::class)
        ->set('state', ['name' => 'Test Name', 'email' => 'test@example.com'])
        ->call('updateProfileInformation');

    assertEquals('Test Name', $user->fresh()?->name);
    assertEquals('test@example.com', $user->fresh()?->email);
});
