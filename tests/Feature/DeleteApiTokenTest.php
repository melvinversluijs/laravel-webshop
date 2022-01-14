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
use function PHPUnit\Framework\assertCount;
use function uses;

uses(RefreshDatabase::class);

it('can delete an API token', function () {
    $user = User::factory()->createOne();
    actingAs($user);
    $token = $user->tokens()->create([
        'name' => 'Test Token',
        'token' => Str::random(40),
        'abilities' => ['create', 'read'],
    ]);

    // @phpstan-ignore-next-line -- id should be available here, otherwise test will fail anyway.
    $tokenId = $token->id;
    Livewire::test(ApiTokenManager::class)
        ->set(['apiTokenIdBeingDeleted' => $tokenId])
        ->call('deleteApiToken');

    $tokens = $user->fresh()?->tokens;
    if ($tokens === null) {
        throw new LogicException('Could not properly refresh user.');
    }

    assertCount(0, $tokens);
});
