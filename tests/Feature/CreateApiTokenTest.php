<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;
use Livewire\Livewire;
use Tests\TestCase;

class CreateApiTokenTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws Exception
     */
    public function testApiTokensCanBeCreated(): void
    {
        $user = User::factory()->createOne();
        $this->actingAs($user);
        Livewire::test(ApiTokenManager::class)
                    ->set(['createApiTokenForm' => [
                        'name' => 'Test Token',
                        'permissions' => [
                            'read',
                            'update',
                        ],
                    ],
                    ])
                    ->call('createApiToken');

        $user = $user->fresh();
        if ($user === null) {
            throw new Exception('Could not properly refresh user.');
        }

        self::assertCount(1, $user->tokens);
        self::assertEquals('Test Token', $user->tokens->first()?->name);
        self::assertTrue($user->tokens->first()?->can('read'));
        self::assertFalse($user->tokens->first()?->can('delete'));
    }
}
