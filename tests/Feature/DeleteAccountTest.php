<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\DeleteUserForm;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;

    public function testUserAccountsCanBeDeleted(): void
    {
        $this->actingAs($user = User::factory()->create());
        Livewire::test(DeleteUserForm::class)
            ->set('password', 'password')
            ->call('deleteUser');

        self::assertNull($user->fresh());
    }

    public function testCorrectPasswordMustBeProvidedBeforeAccountCanBeDeleted(): void
    {
        $this->actingAs($user = User::factory()->create());
        Livewire::test(DeleteUserForm::class)
            ->set('password', 'wrong-password')
            ->call('deleteUser')
            ->assertHasErrors(['password']);

        self::assertNotNull($user->fresh());
    }
}
