<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;
use Livewire\Livewire;
use LogicException;

use function it;
use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;
use function uses;

uses(RefreshDatabase::class);

it('tests API token permissions can be updated.', function () {
    $user = User::factory()->createOne();
    actingAs($user);
    $token = $user->tokens()->create([
        'name' => 'Test Token',
        'token' => Str::random(40),
        'abilities' => ['create', 'read'],
    ]);

    Livewire::test(ApiTokenManager::class)
        ->set(['managingPermissionsFor' => $token])
        ->set(['updateApiTokenForm' => [
            'permissions' => ['delete', 'missing-permission'],
        ],
        ])
        ->call('updateApiToken');

    $user = $user->fresh();
    if ($user === null) {
        throw new LogicException('Could not properly refresh user.');
    }

    assertTrue($user->tokens->first()?->can('delete'));
    assertFalse($user->tokens->first()?->can('read'));
    assertFalse($user->tokens->first()?->can('missing-permission'));
});
