<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Http\Livewire\UpdatePasswordForm;
use Livewire\Livewire;

use function it;
use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertTrue;
use function uses;

uses(RefreshDatabase::class);

it('can update a password', function () {
    $user = User::factory()->createOne();
    actingAs($user);
    Livewire::test(UpdatePasswordForm::class)
        ->set('state', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])
        ->call('updatePassword');

    assertTrue(Hash::check('new-password', (string) $user->fresh()?->password));
});

it('needs a correct password', function () {
    $user = User::factory()->createOne();
    actingAs($user);
    Livewire::test(UpdatePasswordForm::class)
        ->set('state', [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])
        ->call('updatePassword')
        ->assertHasErrors(['current_password']);

    assertTrue(Hash::check('password', (string) $user->fresh()?->password));
});

it('needs passwords to match', function () {
    $user = User::factory()->createOne();
    actingAs($user);
    Livewire::test(UpdatePasswordForm::class)
        ->set('state', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'wrong-password',
        ])
        ->call('updatePassword')
        ->assertHasErrors(['password']);

    assertTrue(Hash::check('password', (string) $user->fresh()?->password));
});
