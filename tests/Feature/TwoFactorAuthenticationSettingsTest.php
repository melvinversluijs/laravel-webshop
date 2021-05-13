<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\TwoFactorAuthenticationForm;
use Livewire\Livewire;
use Tests\TestCase;

use function array_diff;
use function time;

class TwoFactorAuthenticationSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function testTwoFactorAuthenticationCanBeEnabled(): void
    {
        $this->actingAs($user = User::factory()->create());
        $this->withSession(['auth.password_confirmed_at' => time()]);

        Livewire::test(TwoFactorAuthenticationForm::class)
                ->call('enableTwoFactorAuthentication');

        $user = $user->fresh();

        self::assertNotNull($user->two_factor_secret);
        self::assertCount(8, $user->recoveryCodes());
    }

    public function testRecoveryCodesCanBeRegenerated(): void
    {
        $this->actingAs($user = User::factory()->create());
        $this->withSession(['auth.password_confirmed_at' => time()]);

        $component = Livewire::test(TwoFactorAuthenticationForm::class)
                ->call('enableTwoFactorAuthentication')
                ->call('regenerateRecoveryCodes');

        $user = $user->fresh();
        $component->call('regenerateRecoveryCodes');

        self::assertCount(8, $user->recoveryCodes());
        self::assertCount(8, array_diff($user->recoveryCodes(), $user->fresh()->recoveryCodes()));
    }

    public function testTwoFactorAuthenticationCanBeDisabled(): void
    {
        $this->actingAs($user = User::factory()->create());
        $this->withSession(['auth.password_confirmed_at' => time()]);

        $component = Livewire::test(TwoFactorAuthenticationForm::class)
                ->call('enableTwoFactorAuthentication');

        self::assertNotNull($user->fresh()->two_factor_secret);

        $component->call('disableTwoFactorAuthentication');

        self::assertNull($user->fresh()->two_factor_secret);
    }
}
