<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\DeleteUserForm;
use Livewire\Livewire;

use function it;
use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;
use function uses;

uses(RefreshDatabase::class);

it('can delete user accounts', function () {
    $user = User::factory()->createOne();
    actingAs($user);
    Livewire::test(DeleteUserForm::class)
        ->set('password', 'password')
        ->call('deleteUser');

    assertNull($user->fresh());
});

it('needs a correct password before deleting an account', function () {
    $user = User::factory()->createOne();
    actingAs($user);
    Livewire::test(DeleteUserForm::class)
        ->set('password', 'wrong-password')
        ->call('deleteUser')
        ->assertHasErrors(['password']);

    assertNotNull($user->fresh());
});
