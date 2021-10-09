<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function testCurrentProfileInformationIsAvailable(): void
    {
        $user = User::factory()->createOne();
        $this->actingAs($user);
        $component = Livewire::test(UpdateProfileInformationForm::class);

        self::assertEquals($user->name, $component->state['name']);
        self::assertEquals($user->email, $component->state['email']);
    }

    public function testProfileInformationCanBeUpdated(): void
    {
        $user = User::factory()->createOne();
        $this->actingAs($user);
        Livewire::test(UpdateProfileInformationForm::class)
                ->set('state', ['name' => 'Test Name', 'email' => 'test@example.com'])
                ->call('updateProfileInformation');

        self::assertEquals('Test Name', $user->fresh()?->name);
        self::assertEquals('test@example.com', $user->fresh()?->email);
    }
}
