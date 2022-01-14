<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

use function it;
use function now;
use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;
use function sha1;
use function uses;

uses(RefreshDatabase::class);

it('can render email verification page', function () {
    actingAs(User::factory()->createOne(['email_verified_at' => null]))
        ->get('/email/verify')
        ->assertStatus(Response::HTTP_OK);
});

it('can verify an email', function () {
    Event::fake();
    $user = User::factory()->createOne([
        'email_verified_at' => null,
    ]);

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)]
    );

    $response = actingAs($user)->get($verificationUrl);

    Event::assertDispatched(Verified::class);

    assertTrue($user->fresh()?->hasVerifiedEmail());
    $response->assertRedirect('?verified=1');
});

it('can\'t verify an email with an invalid hash', function () {
    $user = User::factory()->createOne([
        'email_verified_at' => null,
    ]);

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1('wrong-email')]
    );

    actingAs($user)->get($verificationUrl);
    assertFalse($user->fresh()?->hasVerifiedEmail());
});
