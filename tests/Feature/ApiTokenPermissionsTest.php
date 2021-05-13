<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;
use Livewire\Livewire;
use Tests\TestCase;

class ApiTokenPermissionsTest extends TestCase
{
    use RefreshDatabase;

    public function testApiTokenPermissionsCanBeUpdated(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $token = $user->tokens()->create([
            'name' => 'Test Token',
            'token' => Str::random(40),
            'abilities' => ['create', 'read'],
        ]);

        Livewire::test(ApiTokenManager::class)
                    ->set(['managingPermissionsFor' => $token])
                    ->set(['updateApiTokenForm' => [
                        'permissions' => [
                            'delete',
                            'missing-permission',
                        ],
                    ],
                    ])
                    ->call('updateApiToken');

        self::assertTrue($user->fresh()->tokens->first()->can('delete'));
        self::assertFalse($user->fresh()->tokens->first()->can('read'));
        self::assertFalse($user->fresh()->tokens->first()->can('missing-permission'));
    }
}
