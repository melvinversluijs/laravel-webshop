<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

use function now;
use function sha1;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function testEmailVerificationScreenCanBeRendered(): void
    {
        $user = User::factory()->createOne([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get('/email/verify');
        $response->assertStatus(200);
    }

    public function testEmailCanBeVerified(): void
    {
        Event::fake();
        $user = User::factory()->createOne([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        Event::assertDispatched(Verified::class);

        self::assertTrue($user->fresh()?->hasVerifiedEmail());
        $response->assertRedirect(RouteServiceProvider::HOME . '?verified=1');
    }

    public function testEmailCanNotVerifiedWithInvalidHash(): void
    {
        $user = User::factory()->createOne([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($user)->get($verificationUrl);
        self::assertFalse($user->fresh()?->hasVerifiedEmail());
    }
}
