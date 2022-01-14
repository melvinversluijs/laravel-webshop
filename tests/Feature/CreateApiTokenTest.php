<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;
use Livewire\Livewire;
use LogicException;

use function it;
use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;
use function uses;

uses(RefreshDatabase::class);

it('can create api tokens', function () {
    $user = User::factory()->createOne();
    actingAs($user);
    Livewire::test(ApiTokenManager::class)
        ->set(['createApiTokenForm' => [
            'name' => 'Test Token',
            'permissions' => ['read', 'update'],
        ],
        ])
        ->call('createApiToken');

    $user = $user->fresh();
    if ($user === null) {
        throw new LogicException('Could not properly refresh user.');
    }

    assertCount(1, $user->tokens);
    assertEquals('Test Token', $user->tokens->first()?->name);
    assertTrue($user->tokens->first()?->can('read'));
    assertFalse($user->tokens->first()?->can('delete'));
});
