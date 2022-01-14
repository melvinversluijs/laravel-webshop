<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\TwoFactorAuthenticationForm;
use Livewire\Livewire;

use function array_diff;
use function it;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\withSession;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;
use function time;
use function uses;

uses(RefreshDatabase::class);

it('can enable 2FA', function () {
    $user = User::factory()->createOne();
    actingAs($user);
    withSession(['auth.password_confirmed_at' => time()]);

    Livewire::test(TwoFactorAuthenticationForm::class)
        ->call('enableTwoFactorAuthentication');

    $user = $user->fresh();

    assertNotNull($user?->two_factor_secret);
    assertCount(8, $user?->recoveryCodes() ?? []);
});

it('can regenerate recovery codes', function () {
    $user = User::factory()->createOne();
    actingAs($user);
    withSession(['auth.password_confirmed_at' => time()]);

    $component = Livewire::test(TwoFactorAuthenticationForm::class)
        ->call('enableTwoFactorAuthentication')
        ->call('regenerateRecoveryCodes');

    $user = $user->fresh();
    $component->call('regenerateRecoveryCodes');

    assertCount(8, $user?->recoveryCodes() ?? []);
    assertCount(8, array_diff($user?->recoveryCodes() ?? [], $user?->fresh()?->recoveryCodes() ?? []));
});

it('can disable 2FA', function () {
    $user = User::factory()->createOne();
    actingAs($user);
    withSession(['auth.password_confirmed_at' => time()]);

    $component = Livewire::test(TwoFactorAuthenticationForm::class)
        ->call('enableTwoFactorAuthentication');

    assertNotNull($user->fresh()?->two_factor_secret);

    $component->call('disableTwoFactorAuthentication');

    assertNull($user->fresh()?->two_factor_secret);
});
