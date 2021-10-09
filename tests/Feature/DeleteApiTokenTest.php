<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteApiTokenTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws Exception
     */
    public function testApiTokensCanBeDeleted(): void
    {
        $user = User::factory()->createOne();
        $this->actingAs($user);
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
            throw new Exception('Could not properly refresh user.');
        }

        self::assertCount(0, $tokens);
    }
}
