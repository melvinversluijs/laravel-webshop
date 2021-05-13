<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;
use Livewire\Livewire;
use Tests\TestCase;

class CreateApiTokenTest extends TestCase
{
    use RefreshDatabase;

    public function testApiTokensCanBeCreated(): void
    {
        $this->actingAs($user = User::factory()->create());
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

        self::assertCount(1, $user->fresh()->tokens);
        self::assertEquals('Test Token', $user->fresh()->tokens->first()->name);
        self::assertTrue($user->fresh()->tokens->first()->can('read'));
        self::assertFalse($user->fresh()->tokens->first()->can('delete'));
    }
}
